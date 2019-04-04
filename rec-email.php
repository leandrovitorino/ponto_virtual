<?php 
session_start();
include_once "conexao.php";
include_once "funcoes/funcao.php";
header("Content-type: text/html; charset=utf-8");

$email= $_POST['email'];

//Consulta se o e-mail existe no banco de dados
$consulta = "SELECT email FROM usuarios WHERE email like '$email'";
$resposta = (mysqli_query($conn, $consulta));
$result = mysqli_num_rows ($resposta);

//Gerando uma nova senha aleatória
$nova_senha = senha();

if($result > 0 ){

	$linha = mysqli_fetch_array($resposta);

    $emailRecuperado = $linha["email"];
    $msg = "Sua nova senha: $nova_senha";

    //Alterando a senha do banco de dados para a nova
    $sql = "UPDATE usuarios SET senha = MD5('$nova_senha') WHERE email = '$_POST[email]'";
	$att = mysqli_query($conn, $sql);

	$mensagem = $msg;
	$destinatario = $email;
	$assunto = "Recuperacao de senha";
	$headers = "Bcc: leandro@leandrovitorino.x-br.com";
	//Enviando o e-mail
	ini_set('sendmail_from', 'leandro@leandrovitorino.x-br.com');
	mail($destinatario, $assunto, $mensagem, $headers);

	?>
		<SCRIPT Language="javascript">
		alert('E-mail enviado com sucesso!');
		location.href="index.php";
		</SCRIPT>
	<?
}else{
    ?>
		<SCRIPT Language="javascript">
		alert('E-mail não encontrado na base de dados!');
		location.href="index.php";
		</SCRIPT>
	<?
}
 ?>