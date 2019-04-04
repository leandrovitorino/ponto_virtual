<?php

   session_start();
	if($_SESSION['usuarioNiveisAcessoId'] == 1){	
	include_once "menu.php";
	}else{	
	include_once "menu-op.php";
	}
    include_once("../conexao.php");
   
   if(!empty($_POST['DI'])){
		$DI=(date("Y-m-d", strtotime($_POST['DI'])));
		$_SESSION['DI']=$DI;
	}else if(!empty($_SESSION['DI'])){
		$DI=$_SESSION['DI'];
	}else{
		$DI=date('Y-m-01');
		$_SESSION['DI']=$DI;
	}
	if(!empty($_POST['DF'])){
		$DF=(date("Y-m-d", strtotime($_POST['DF'])));
		$_SESSION['DF']=$DF;
	}else if(!empty($_SESSION['DF'])){
		$DF=$_SESSION['DF'];
	}else{
		$DF=date('Y-m-d');
		$_SESSION['DF']=$DF;
	}

	if (isset($_POST['DI']) && empty($_POST['DI'])){
		$DI = date("Y-m-01");
	}
	if (isset($_POST['DF']) && empty($_POST['DF'])){
		$DI = date("Y-m-d");
	}

   $busca = "SELECT * FROM relatorio WHERE id = '$_SESSION[usuarioId]' && STR_TO_DATE(data, '%d/%m/%Y') BETWEEN '$DI' and '$DF' ORDER BY data DESC";

   $total_reg = "10"; // número de registros por página
	if (empty($_GET['pagina'])) {
		$_GET['pagina']=1;
	}
	$pagina=$_GET['pagina'];
	if (!$pagina) {
	$pc = "1";
	} else {
	$pc = $pagina;
	}

	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;

	$limite = mysqli_query($conn, "$busca LIMIT $inicio,$total_reg");
	$todos = mysqli_query($conn, "$busca");

	$tr = mysqli_num_rows($todos); // verifica o número total de registros
	$tp = $tr / $total_reg; // verifica o número total de páginas
	$fim = intval($tp);
	?>
<html>
	<head>
		<title>Relatório</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" type="text/css" href="../css/stylo.css">
	</head>
<body>
	<div class="limiter">
	<div class="container-table100">
	<div class="wrap-table100">
	<div class="table100">
	<fieldset id="av-filtro">
	<legend>Filtro</legend>
	<form action="relatorio.php" method="POST">
	<label id="lbl-av-periodo" for="DtInicial">Período:</label>
	<input type="date" name="DI">
	<input type="date" name="DF">	
	<button type="submit" name="Ok" value="Ok" class='css3button'>Ok</button>
	</form>
	</fieldset>
		<table>
			<thead>
				<p align="Center">
				<tr class="table100-head">
					<th class="column1">Nome</th>
					<th class="column1">Data</th>
					<th class="column1">Entrada</th>
					<th class="column1">Intervalo</th>
					<th class="column1">Volta</th>
					<th class="column1">Saída</th>
					<th class="column1">Extra</th>
					<th class="column1">Atraso</th>
				</tr>
				</p>
			</thead>
			<tbody>
<?
	// se o número de resultados for maior que zero, mostra os dados
	if($tr > 0) {
		// inicia o loop que vai mostrar todos os dados
		while($linha = mysqli_fetch_assoc($limite)){//do {
?>
				<tr>
					<td class="column1"><?=$linha['nome']?></td>
					<td class="column1"><?=$linha['data']?></td>
					<td class="column1"><?=$linha['ent1']?></td>
					<td class="column1"><?=$linha['sai1']?></td>
					<td class="column1"><?=$linha['ent2']?></td>
					<td class="column1"><?=$linha['sai2']?></td>
					<td class="column1"><?=$linha['horas']?></td>
					<td class="column1"><?=$linha['atraso']?></td> 
				</tr>	
<?
		// finaliza o loop que vai mostrar os dados
		}
	}
?>
			</tbody>
			</table>
			<br>
			<p align="Center">
			<?
				$anterior = $pc -1;
				$proximo = $pc +1;

				if($_GET['pagina']!=1){
				echo " <a href='?pagina=1'> <button type='submit' class='css3button' value='primeirapag'> Primeira Página </button></a>";
				echo " "." ";
				}
				if ($pc>1) {
				echo " <a href='?pagina=$anterior'> <button type='submit' class='css3button' value='Anterior'><- Anterior</button></a> ";
				}
				echo " "." ";
				if ($pc<$tp) {
				echo " <a href='?pagina=$proximo'> <button type='submit' class='css3button' value='Anterior'>Próxima -></button></a> ";
				//echo " <a href='?pagina=$proximo'>Próxima -></a>";
				}
				echo " "." ";
				if ($tp >$fim){
					$fim=$fim+1;
				}
				if($_GET['pagina']!=$fim){
				echo " <a href='?pagina=$fim'> <button type='submit' class='css3button' value='ultpag'> Última Página </button> </a>";
				}
			?>
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
<?
mysqli_close($conn);
?>