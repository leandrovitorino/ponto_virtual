<?php
	session_start();
	include_once "menu.php";
	include_once "conexao.php";
?>
<?
	$data= date("d/m/Y");
	$query = "SELECT ent1, sai1, ent2, sai2 FROM relatorio WHERE data = '$data' && id = '$_SESSION[usuarioId]'";
	// executa a query
	$dados = mysqli_query($conn, $query);
	// transforma os dados em um array
	$linha = mysqli_fetch_assoc($dados);
?>
	<html>
		<head>
			<title>Home</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
			<link rel="stylesheet" type="text/css" href="usuarios/vendor/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="usuarios/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="usuarios/vendor/animate/animate.css">
			<link rel="stylesheet" type="text/css" href="usuarios/vendor/select2/select2.min.css">
			<link rel="stylesheet" type="text/css" href="usuarios/vendor/perfect-scrollbar/perfect-scrollbar.css">
			<link rel="stylesheet" type="text/css" href="usuarios/css/util.css">
			<link rel="stylesheet" type="text/css" href="usuarios/css/main.css">
			<link rel="stylesheet" type="text/css" href="usuarios/css/style.css">
			<link rel="stylesheet" type="text/css" href="css/stylo.css">
		</head>
		<body>
			<form action="ponto.php" method="POST">
			<div class="limiter">
			<div class="container-table100">
			<div class="wrap-table100">
			<div class="table100">
			<a align="Center"><h1>Ponto Virtual</h1></a><br><br>
				<table>
					<thead>
						<p align="Center">
						<tr class="table100-head">
							<th class="column1">Nome</th>
							<th class="column2">Data</th>
							<th class="column3">Entrada</th>
							<th class="column3">Intervalo</th>
							<th class="column3">Volta</th>
							<th class="column3">Saída</th>
						</tr>
						</p>
					</thead>
					<tbody>
						<tr>
							<td class="column1"> <? echo "$_SESSION[usuarioNome]" ?> </td>
							<td class="column2"><? echo date("d/m/Y") ?></td>
							<td class="column3">
							<? 
								if(!empty($linha['ent1'])){
									echo $linha['ent1'];
								}else{
							?>	
							<button type="submit" name="entrada" value="1" class="btn btn-sm btn-success">Ok</button>
							<? } ?>
							</td>
							<td class="column3">
							<? 
								if (empty($linha['ent1'])){
									?> <button type="submit" name="intervalo" value="1" disabled="disabled" class="btn btn-sm btn-danger">Ok</button><?
								}else if(!empty($linha['sai1'])){
									echo $linha['sai1'];
								}else{
							?>	
							<button type="submit" name="intervalo" value="1" class="btn btn-sm btn-success">Ok</button>
							<? } ?>
							</td>
							<td class="column3">
							<? 
								if (empty($linha['sai1'])){
									?> <button type="submit" name="volta" value="1" disabled="disabled" class="btn btn-sm btn-danger">Ok</button><?
								}else if(!empty($linha['ent2'])){
									echo $linha['ent2'];
								}else{
							?>	
							<button type="submit" name="volta" value="1" class="btn btn-sm btn-success">Ok</button>
							<? } ?>
							</td>
							<td class="column3">
							<? 
								if (empty($linha['ent2'])){
									?> <button type="submit" name="saida" value="1" disabled="disabled" class="btn btn-sm btn-danger">Ok</button><?
								}else if(!empty($linha['sai2'])){
									echo $linha['sai2'];
								}else{
							?>		
							<button type="submit" name="saida" value="1" class="btn btn-sm btn-success">Ok</button>
							<? } ?>	
							</td> 	
						</tr>	
					</tbody>
					</table>
			</div>
			</div>
			</div>
			</div>
			<script src="usuarios/vendor/jquery/jquery-3.2.1.min.js"></script>
			<script src="usuarios/vendor/bootstrap/js/popper.js"></script>
			<script src="usuarios/vendor/bootstrap/js/bootstrap.min.js"></script>
			<script src="usuarios/vendor/select2/select2.min.js"></script>
			<script src="usuarios/js/main.js"></script>
			</form>
		</body>
		<?include_once "footer.html";?>
	</html>