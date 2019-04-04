<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Leandro Vitorino">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/stylo.css">
        <title>Ponto Virtual</title>
    </head>
    <body>
        <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Account Login
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="valida.php">
                    <div class="wrap-input100 validate-input" data-validate = "Entre com seu e-mail">
                        <input class="input100" type="email" name="email" placeholder="Email" required minlength="2">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>    
                    <div class="wrap-input100 validate-input" data-validate="Entre com a senha">
                    <input class="input100" type="password" name="senha" placeholder="Senha" required minlength="3">
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit"> Acessar</button>
                    </div>
                    <br><p align="Center"><a href="esqueci.senha.php"><label>Esqueceu a senha?</label></a></p>
                </form>
            </div>
        </div>
        </div>
        <?if(isset($_SESSION['usuarioNiveisAcessoId']) && $_SESSION['usuarioNiveisAcessoId'] == 1){
            header("Location: administrativo.php");
        }else if(isset($_SESSION['usuarioNiveisAcessoId']) && $_SESSION['usuarioNiveisAcessoId'] == 2){
            header("Location: colaborador.php");
        }else{
            ?>
            <p>
                <?php if(isset($_SESSION['loginErro'])){
                    echo $_SESSION['loginErro'];
                    unset($_SESSION['loginErro']);
                }?>
            </p>
            <p>
                <?php 
                if(isset($_SESSION['logindeslogado'])){
                    echo $_SESSION['logindeslogado'];
                    unset($_SESSION['logindeslogado']);
                }
                ?>
            </p>
            <?
        }
            ?>
        <div id="dropDownSelect1"></div>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>
    <?include_once "footer.html";?>
    </body>
</html>