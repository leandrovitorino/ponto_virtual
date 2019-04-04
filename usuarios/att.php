<?php 

	session_start();
	include_once "../conexao.php";

	if (isset($_POST['senha']) && strlen($_POST['senha']) < 3){
?>
		<SCRIPT Language="javascript">
		alert('A senha precisa ter pelo menos 3 dígitos!');
		location.href="alterar.funcionario.php";
		</SCRIPT>
<?	
	}else if ((empty($_POST['nome'])) || (empty($_POST['email'])) || (empty($_POST['nvl']))){
		?>
			<SCRIPT Language="javascript">
			alert('Os campos precisam estar preenchidos!');
			location.href="alterar.php";
			</SCRIPT>
		<?
	}else if (!empty($_POST['senha'])){
		$sql = "UPDATE usuarios SET nome = '$_POST[nome]', email = '$_POST[email]', senha = MD5('$_POST[senha]'), situacoe_id = '$_POST[carga]', niveis_acesso_id = '$_POST[nvl]' WHERE id = $_SESSION[id]";
		$att = mysqli_query($conn, $sql);
	?>
		<SCRIPT Language="javascript">
		alert('Os dados do usuário foram alterados com sucesso!');
		location.href="alterar.funcionario.php";
		</SCRIPT>
	<?
	}else{
		$sql = "UPDATE usuarios SET nome = '$_POST[nome]', email = '$_POST[email]', situacoe_id = '$_POST[carga]', niveis_acesso_id = '$_POST[nvl]' WHERE id = $_SESSION[id]";
		$att = mysqli_query($conn, $sql);
	?>
		<SCRIPT Language="javascript">
		alert('Os dados do usuário foram alterados com sucesso!');
		location.href="alterar.funcionario.php";
		</SCRIPT>
	<?
	}
	mysqli_close($conn);
?>