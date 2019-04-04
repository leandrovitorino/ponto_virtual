<?php
session_start();
include_once "../conexao.php";

// Verificar se algum radiobox foi selecionado
if(empty("$_POST[excluir]")){
	?>
	   <SCRIPT Language="javascript">
	   	alert('Nenhum usuário foi selecionado!');
	   	location.href="index.php";
	   </SCRIPT>
	<?
}else{

// Deletar os pontos do relatório
$remove = "DELETE FROM `relatorio` WHERE `id` = $_POST[excluir]";
$query = mysqli_query($conn, $remove);
// Deletar o usuário do banco
$sql = "DELETE FROM `usuarios` WHERE `id` = $_POST[excluir]";

if (!mysqli_query($conn,$sql))
{
    die('Error: ' . mysqli_error($conn));
}
mysqli_close($conn);
?>
<SCRIPT Language="javascript">
alert('Funcionário removido com sucesso!');
location.href='index.php';
</SCRIPT>
<?
}
?> 