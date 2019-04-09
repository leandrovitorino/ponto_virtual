<?php 
	session_start();
	include_once "conexao.php";	
	include_once "funcoes/funcao.php";
?>
<?php
	$sql = "SELECT * FROM usuarios WHERE id = '$_SESSION[usuarioId]' ";
	$query = mysqli_query($conn, $sql);
	$linha = mysqli_fetch_assoc($query);
	
	if ($linha['situacoe_id'] == 1){
		$intervalo = "01:00:00";
		$final = "08:00:00";
	}else if ($linha['situacoe_id'] == 2){
		$intervalo = "00:30:00";
		$final = "05:30:00";
	}else{
		$intervalo = "01:00:00";
		$final = "07:00:00";
	}

	$dia = date("d/m/Y");
	$hora = date("H:i:s");

	if (! empty($_POST['entrada'])){
		$dado = "SELECT * FROM relatorio WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
		$busca = mysqli_query($conn, $dado);
		$linha = mysqli_fetch_assoc($busca);

		if(!empty($linha['ent1']) && isset($linha['ent1'])){
?>
			<SCRIPT Language="javascript">
			alert('A entrada já foi computada!');
			location.href='administrativo.php';
			</SCRIPT>
<?
		}else{

			$sql="INSERT INTO relatorio (`data`, `nome`, `ent1`, `id`) VALUES ('$dia', '$_SESSION[usuarioNome]', '$hora', '$_SESSION[usuarioId]')";
			$query=mysqli_query($conn, $sql);
?>		
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('Entrada cadastrada com sucesso!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?>
			<SCRIPT Language="javascript">
			alert('Entrada cadastrada com sucesso!');
			location.href='administrativo.php';
			</SCRIPT>
<?
			}
		}
	}else if (! empty($_POST['intervalo'])){

		$dado = "SELECT * FROM relatorio WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
		$busca = mysqli_query($conn, $dado);
		$linha = mysqli_fetch_assoc($busca);
		
		if (empty($linha['ent1'])){
?>
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('O ponto anterior não foi computado!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?> 
			<SCRIPT Language="javascript">
			alert('O ponto anterior não foi computado!');
			location.href='administrativo.php';
			</SCRIPT>
<?
			}
		}else if(!empty($linha['sai1']) && isset($linha['sai1'])){
?>
			<SCRIPT Language="javascript">
			alert('O intervalo já foi computado!');
			location.href='administrativo.php';
			</SCRIPT>
<?
		}else{
			$tempo = dif_hora($linha['ent1'], $hora);
		
			$sql = "UPDATE relatorio SET sai1 = '$hora', horas = '$tempo' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
			$query = mysqli_query($conn, $sql);

?>
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('Intervalo cadastrado com sucesso!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?> 
			<SCRIPT Language="javascript">
			alert('Intervalo cadastrado com sucesso!');
			location.href='administrativo.php';
			</SCRIPT>
<?
			}
		}
	}else if (! empty($_POST['volta'])){

		$dado = "SELECT * FROM relatorio WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
		$busca = mysqli_query($conn, $dado);
		$linha = mysqli_fetch_assoc($busca);

		if (empty($linha['sai1']) || empty($linha['ent1'])){
?>
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('Algum ponto anterior não foi computado!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?> 
			<SCRIPT Language="javascript">
			alert('Algum ponto anterior não foi computado!');
			location.href='administrativo.php';
			</SCRIPT>
<?
			}
		}else if (!empty($linha['ent2']) && isset($linha['ent2'])){
?>
			<SCRIPT Language="javascript">
			alert('A volta já foi computada!');
			location.href='administrativo.php';
			</SCRIPT>
<?
		}else{
			$tempo = dif_hora($linha['sai1'], $hora);
			intervalo($tempo, $intervalo, $conn);

			$sql="UPDATE relatorio SET ent2 = '$hora' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
			$query=mysqli_query($conn, $sql);
	?>
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('Volta do intervalo cadastrada com sucesso!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?> 
			<SCRIPT Language="javascript">
			alert('Volta do intervalo cadastrada com sucesso!');
			location.href='administrativo.php';
			</SCRIPT>
	<?
			}
		}
	}else if (! empty($_POST['saida'])){
		$dado = "SELECT * FROM relatorio WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
		$busca = mysqli_query($conn, $dado);
		$linha = mysqli_fetch_assoc($busca);
		if (empty($linha['ent2']) || (empty($linha['ent1'])) || (empty($linha['sai1']))){
?>
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('Algum ponto anterior não foi computado!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?> 
			<SCRIPT Language="javascript">
			alert('Algum ponto anterior não foi computado!');
			location.href='administrativo.php';
			</SCRIPT>
<?
			}
		}else if (!empty($linha['sai2']) && isset($linha['sai2'])){
?>
			<SCRIPT Language="javascript">
			alert('A saída já foi computada!');
			location.href='administrativo.php';
			</SCRIPT>
<?
		}else{
			$tempo = dif_hora($linha['ent2'], $hora);
			$soma = soma_hora($tempo, $linha['horas']);

			$sql = "UPDATE relatorio SET sai2 = '$hora', horas = '$soma' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
			$query = mysqli_query($conn, $sql);

			$dado = "SELECT * FROM relatorio WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
			$busca = mysqli_query($conn, $dado);
			$linha = mysqli_fetch_assoc($busca);

			calc_horas($linha['horas'], $final);
			$zero = "00:00:00";
			if (isset($_SESSION['atraso']) && !empty($_SESSION['atraso'])){
				$soma = soma_hora($linha['atraso'], $_SESSION['atraso']);
				$sql = "UPDATE relatorio SET atraso = '$soma', horas = '$zero' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
				$query = mysqli_query($conn, $sql);
			}else{
				$extra = $_SESSION['extra'];
				$sub = sub_hora($_SESSION['extra'], $linha['atraso']);
				if (isset($_SESSION['atraso']) && !empty($_SESSION['atraso'])){
					$soma = soma_hora($linha['atraso'], $_SESSION['atraso']);
				$sql = "UPDATE relatorio SET atraso = '$soma', horas = '$zero' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
				$query = mysqli_query($conn, $sql);
				}else{
					$sql = "UPDATE relatorio SET horas = '$extra', atraso = '$zero' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
					$query = mysqli_query($conn, $sql);
				}
			}
?>
			<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
			<SCRIPT Language="javascript">
			alert('Saída cadastrada com sucesso!');
			location.href='colaborador.php';
			</SCRIPT>
			<? }else{ ?> 
			<SCRIPT Language="javascript">
			alert('Saída cadastrada com sucesso!');
			location.href='administrativo.php';
			</SCRIPT>
	<?
			}
		}
	}else{
?>
		<? if ($_SESSION['usuarioNiveisAcessoId'] != 1){ ?>
		<SCRIPT Language="javascript">
		alert('ERRO! Ponto não cadastrado!');
		location.href='colaborador.php';
		</SCRIPT>
		<? }else{ ?> 
		<SCRIPT Language="javascript">
		alert('ERRO! Ponto não cadastrado!');
		location.href='administrativo.php';
		</SCRIPT>
<?
		}
	}
	mysqli_close($conn);
?>