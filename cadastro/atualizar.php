<?php 

session_start();
include_once("../conexao.php");

if (isset($_POST['senha']) && strlen($_POST['senha']) < 3 ){
?>
		<SCRIPT Language="javascript">
		alert('A senha precisa ter pelo menos 3 dígitos!');
		location.href="usuario.php";
		</SCRIPT>
<?
}else if($_SESSION['usuarioNiveisAcessoId'] == 1){
	if ((empty($_POST['nome'])) || (empty($_POST['email']))){
		?>
			<SCRIPT Language="javascript">
			alert('Os campos precisam estar preenchidos!');
			location.href="usuario.php";
			</SCRIPT>
		<?
	}else if (!empty($_POST['senha'])){
		$sql = "UPDATE usuarios SET nome = '$_POST[nome]', email = '$_POST[email]', senha = MD5('$_POST[senha]'), situacoe_id = '$_POST[carga]' WHERE id = '$_SESSION[usuarioId]'";
		$att = mysqli_query($conn, $sql);
?>
		<SCRIPT Language="javascript">
		alert('Dados alterados com sucesso! Efetue o Login novamente.');
		location.href="../sair.php";
		</SCRIPT>
<?
	}else{
		$sql = "UPDATE usuarios SET nome = '$_POST[nome]', email = '$_POST[email]', situacoe_id = '$_POST[carga]' WHERE id = '$_SESSION[usuarioId]'";
		$att = mysqli_query($conn, $sql);
?>
		<SCRIPT Language="javascript">
		alert('Dados alterados com sucesso! Efetue o Login novamente.');
		location.href="../sair.php";
		</SCRIPT>
<?
	}
}else{

	if (empty($_POST['senha'])){
?>
		<SCRIPT Language="javascript">
		alert('A senha precisa ser preenchida!');
		location.href="usuario.php";
		</SCRIPT>
<?
	}else{
		$sql = "UPDATE usuarios SET senha = MD5('$_POST[senha]') WHERE id = '$_SESSION[usuarioId]'";
		$att = mysqli_query($conn, $sql);
?>
		<SCRIPT Language="javascript">
		alert('Dados alterados com sucesso! Efetue o Login novamente.');
		location.href="../sair.php";
		</SCRIPT>
<?
	}
}
?>