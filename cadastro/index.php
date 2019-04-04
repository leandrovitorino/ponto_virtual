<?php
	session_start();
    include_once "../menu.php";
?>
    <html>
    <head>
    	<title>Cadastro</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/stylo.css">
    </head>
<body>
	<div class="bg-contact2" style="background-image: url('images/bg-01.jpg');">
		<div class="container-contact2">
			<div class="wrap-contact2">
				<form action="inserir.php" method="POST" class="contact2-form validate-form">
					<span class="contact2-form-title">
						Cadastro
					</span>
    <div class="wrap-input2 validate-input">  
    	<input type="text" name="nome" class="input2" required="required">
    	<span class="focus-input2" data-placeholder="NOME"></span>
	</div>
	<div class="wrap-input2 validate-input">
    	<input type="email" name="email" class="input2" required="required">
    	<span class="focus-input2" data-placeholder="EMAIL"></span>
    </div>
    <div class="wrap-input2 validate-input">
    	<input type="password" name="senha" class="input2" required="required">
    	<span class="focus-input2" data-placeholder="SENHA"></span>
    </div>
    <div class="wrap-input2 validate-input" >
    	<input type="radio" name="carga" value="1" required="required"> 9 Horas   
    	<input type="radio" name="carga" value="2" required="required" checked> 6 Horas
    	<input type="radio" name="carga" value="3" required="required"> Madrugada
    </div>
    <div class="wrap-input2 validate-input" >
    	<input type="radio" name="nvl" value="1" required="required">Administrador   
    	<input type="radio" name="nvl" value="2" required="required" checked>Funcionário
    </div>
    <div class="container-contact2-form-btn">
		<div class="wrap-contact2-form-btn">
			<div class="contact2-form-bgbtn"></div>
    		<button type="submit" class="contact2-form-btn">Cadastrar
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