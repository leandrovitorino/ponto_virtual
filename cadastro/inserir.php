<?php
session_start();
include_once "../conexao.php";
$hora = date("Y/m/d H:i:s");

$frase = $_POST['email'];
$q = strpos($frase, "@");
$email = substr($frase, $q, strlen($frase));

if($email != "@empresa.com.br"){
    ?>
    <SCRIPT Language="javascript">
    alert('Somente permitido e-mails de: @empresa.com.br');
    location.href="index.php";
    </SCRIPT>
    <?
}else if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['carga']) || empty($_POST['nvl'])){
    ?>
    <SCRIPT Language="javascript">
    alert('Todos os dados são obrigatórios!');
    location.href="index.php";
    </SCRIPT>
    <?
}else if(isset($_POST['email'])){
    $usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection          
        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $result_usuario = "SELECT * FROM usuarios WHERE email = '$usuario' LIMIT 1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);
        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    if(isset($resultado)){
       ?>
       <SCRIPT Language="javascript">
	   alert('O E-mail já está cadastrado!');
	   location.href='index.php';
		</SCRIPT>
     <?   
    }else if (strlen($_POST['senha']) < 3){
        echo strlen($_POST['senha']);
            ?>
            <SCRIPT Language = "javascript">
            alert('A senha OBRIGATORIAMENTE necessita de 3 ou mais dígitos!');
            location.href="index.php";
            </SCRIPT>
            <?
        }else{

    	$sql="INSERT INTO usuarios (`nome`, `email`, `senha`, `situacoe_id`, `niveis_acesso_id`, `created`, `modified`) VALUES ('$_POST[nome]','$_POST[email]', MD5('$_POST[senha]'),'$_POST[carga]','$_POST[nvl]', '$hora', '$hora')";
    	// CASO ESTEJA TUDO OK ADICIONA OS DADOS, SENÃO MOSTRA O ERRO
    	if (!mysqli_query($conn, $sql))
    	{
        	die('Error: ' . mysqli_error($conn));
    	}

    mysqli_close($conn);

    $msg= "Seu cadastro foi efetuado com sucesso, seus dados de acesso sao:
    Usuario: $_POST[email]
    Senha: $_POST[senha]

    Realize o seu login acessando o endereço: https://www.seusite.com/painel

    Atenciosamente,
    Leandro Vitorino
    ";
    $mensagem = $msg;
    $destinatario = $_POST['email'];
    $assunto = "Cadastro - Ponto";
    $headers = "Bcc: leandro@leandrovitorino.x-br.com";

    ini_set('sendmail_from', 'leandro@leandrovitorino.x-br.com');
    mail($destinatario, $assunto, $mensagem, $headers);
?>
    <SCRIPT Language="javascript">
    alert('Funcionário cadastrado com sucesso!');
    location.href='../usuarios';
    </SCRIPT>
<?
}
}
?>