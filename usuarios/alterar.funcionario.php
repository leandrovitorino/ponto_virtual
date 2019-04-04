<?php
session_start();
include_once "menu.php";
include_once "../conexao.php";

$query = sprintf("SELECT id, nome, email, created FROM usuarios");
// executa a query
$dados = mysqli_query($conn, $query) or die(mysql_error());
// transforma os dados em um array
$linha = mysqli_fetch_assoc($dados);
// calcula quantos dados retornaram
$total = mysqli_num_rows($dados);
?>
<html>
	<head>
		<title>Usuários</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/stylo.css">
	</head>
<body>
	<form action="alterar.php" method="POST">
	<div class="limiter">
	<div class="container-table100">
	<div class="wrap-table100">
	<div class="table100">
		<table>
			<thead>
				<tr class="table100-head">
					<th class="column1">Nome</th>
					<th class="column2">E-mail</th>
					<th class="column3">Data de criação</th>
				</tr>
			</thead>
			<tbody>
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
		// inicia o loop que vai mostrar todos os dados
		do {
?>
				<? if ($linha['id'] != $_SESSION['usuarioId']){
					?>
					<tr>
						<td class="column1"><input type="radio" name="alterar" value="<?=$linha['id']?>"> <?=$linha['nome']?></td>
						<td class="column2"><?=$linha['email']?></td>
						<td class="column3"><?=$linha['created']?></td> 
					</tr>	
					<?
				}
				?>
<?php
		// finaliza o loop que vai mostrar os dados
		}while($linha = mysqli_fetch_assoc($dados));
	// fim do if 
	}
?>
			</tbody>
			</table>
			<br>
			<p align="Center">
			<button type="submit" name="Alterar" value="Alterar" class="css3button">Alterar</button>			
			</p>
	</div>
	</div>
	</div>
	</div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>
	</form>
</body>
<?include_once "../footer.html";?>
</html>
<?php
// tira o resultado da busca da memória
mysqli_free_result($dados);
mysqli_close($conn);
?>