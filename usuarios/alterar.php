<?php 
session_start();
include_once "../conexao.php";
include_once "menu.php";

$query = "SELECT * FROM `usuarios` WHERE `id` = $_POST[alterar]";
// executa a query
$dados = mysqli_query($conn, $query);
// transforma os dados em um array
$linha = mysqli_fetch_assoc($dados);

$_SESSION['id'] = $_POST['alterar'];

?>

<html>
	<head>
		<title>Alterar Usuário</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../cadastro/images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="../cadastro/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../cadastro/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../cadastro/vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="../cadastro/vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="../cadastro/vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="../cadastro/css/util.css">
		<link rel="stylesheet" type="text/css" href="../cadastro/css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/stylo.css">
    </head>
	<body>
		<div class="bg-contact2" style="background-image: url('../cadastro/images/bg-01.jpg');">
			<div class="container-contact2">
				<div class="wrap-contact2">
					<form action="att.php" method="POST" class="contact2-form validate-form">
						<span class="contact2-form-title">
							Alterar Usuário
						</span>
						<div class="wrap-input2 validate-input">  
	    					<input type="text" name="nome" class="input2" value="<?=$linha['nome']?>" required="required">
						</div>
						<div class="wrap-input2 validate-input">
					    	<input type="email" name="email" class="input2" value="<?=$linha['email']?>" required="required">
					    </div>
					    <div class="wrap-input2 validate-input">
					    	<input type="password" name="senha" class="input2">
					    	<span class="focus-input2" data-placeholder="SENHA"></span>
					    </div>
					    <?if ($linha['situacoe_id'] == 1){?>
						    <div class="wrap-input2 validate-input" >
	    						<input type="radio" name="carga" value="1" required="required" checked> 9 Horas   
	    						<input type="radio" name="carga" value="2" required="required"> 6 Horas
	    						<input type="radio" name="carga" value="3" required="required"> Madrugada
	    					</div>
    					<?}else if ($linha['situacoe_id'] == 2){?>
	    					<div class="wrap-input2 validate-input" >
	    						<input type="radio" name="carga" value="1" required="required"> 9 Horas   
	    						<input type="radio" name="carga" value="2" required="required" checked> 6 Horas
	    						<input type="radio" name="carga" value="3" required="required"> Madrugada
	    					</div>
	    				<?}else{?>
	    					<div class="wrap-input2 validate-input" >
	    						<input type="radio" name="carga" value="1" required="required"> 9 Horas   
	    						<input type="radio" name="carga" value="2" required="required"> 6 Horas
	    						<input type="radio" name="carga" value="3" required="required" checked> Madrugada
	    					</div>
	    				<?}?>
					    <?if ($linha['niveis_acesso_id'] == 1){?>
						    <div class="wrap-input2 validate-input" >
	    						<input type="radio" name="nvl" value="1" required="required" checked>Administrador   
	    						<input type="radio" name="nvl" value="2" required="required">Funcionário
	    					</div>
    					<?}else{?>
	    					<div class="wrap-input2 validate-input" >
	    						<input type="radio" name="nvl" value="1" required="required">Administrador   
	    						<input type="radio" name="nvl" value="2" required="required" checked>Funcionário
	    					</div>
	    				<?}?>
					    <div class="container-contact2-form-btn">
							<div class="wrap-contact2-form-btn">
								<div class="contact2-form-bgbtn"></div>
					    		<button type="submit" class="contact2-form-btn">Atualizar
					    		</button>
					    	</div>
						</div>
						</form>
				</div>
			</div>
		</div>
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="js/main.js"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
		<script>
		   window.dataLayer = window.dataLayer || [];
		   function gtag(){dataLayer.push(arguments);}
		   gtag('js', new Date());
		   gtag('config', 'UA-23581568-13');
		</script>	
	</body>
	<?include_once "../footer.html";?>
</html>
<?
mysqli_close($conn);
?>