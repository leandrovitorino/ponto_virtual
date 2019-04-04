<?php 
	session_start();
	include_once "menu.php";
	include_once "../conexao.php";
?>
<? 
	$query = "SELECT nome FROM usuarios ORDER BY nome";
// executa a query
	$dados = mysqli_query($conn, $query) or die(mysql_error());
// transforma os dados em um array
	$user = mysqli_fetch_assoc($dados);
// calcula quantos dados retornaram
	$total = mysqli_num_rows($dados);

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
	if (isset($_POST['selectoption']) && !empty($_POST['selectoption'])){
		
		$busca = "SELECT * FROM relatorio WHERE nome = '$_POST[selectoption]' && STR_TO_DATE(data, '%d/%m/%Y') BETWEEN '$DI' and '$DF' ORDER BY id_relatorio DESC";
		$_SESSION['selectoption'] = $_POST['selectoption'];
	}else{
		$_SESSION['selectoption'] = empty($_SESSION['selectoption']);
		
		$busca = "SELECT * FROM relatorio WHERE STR_TO_DATE(data, '%d/%m/%Y') BETWEEN '$DI' and '$DF' ORDER BY id_relatorio DESC";
	}
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
	$tr = mysqli_num_rows($todos); 

	$tp = $tr / $total_reg; 
	$fim = intval($tp);
	?>
	<html>
		<head>
			<title>Relatório - ADMIN</title>
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
			<script src="jquery-latest.js"></script>
	 		<script src="jquery.tablesorter.min.js"></script>
	 		<script src="scripts.js"></script>
		</head>
		<body>
			<div class="limiter">
			<div class="container-table100">
			<div class="wrap-table100">
			<div class="table100">
			<fieldset id="av-filtro">
				<legend>Filtro</legend>
				<form action="relatorio.admin.php" method="POST" id="user">
					<label id="lbl-av-periodo" for="DtInicial">Período:</label>
					<input type="date" name="DI">
					<input type="date" name="DF">
					<button type="submit" name="Ok" value="Ok" class='css3button'>Ok</button><br><br>
					<label>Atendente: </label>
				<?	
					echo "<select name=selectoption>";
					
					echo "<option value=''> Selecione o usuario </option>";

					if($total > 0){
						do{
					echo "<option value='$user[nome]'> $user[nome] </option>";			
						}while ($user = mysqli_fetch_assoc($dados));
					}
					echo "</select>"; 

					if ($_SESSION['selectoption'] == 1){
						$_SESSION['selectoption'] = empty($_SESSION['selectoption']);
					}

				?>
				</form>
			</fieldset>
			
				<table class="tablesorter">
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
			
			if($tr > 0) {

				while($linha = mysqli_fetch_assoc($limite)){
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
							
							}
							echo " "." ";
							if ($tp >$fim){
								$fim=$fim+1;
							}
							if($_GET['pagina']!=$fim){
							echo " <a href='?pagina=$fim'> <button type='submit' class='css3button' value='ultpag'> Última Página </button> </a>";
							}
							echo "<br><br>";
							echo " <a href='pdf.php' target='_blank'> <button type='submit' class='css3button' value='pdf'> Gerar PDF </button></a> ";
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
	</html>
<?	
	include_once "../footer.html";
	mysqli_close($conn);
?>