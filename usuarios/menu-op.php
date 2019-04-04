<?php
   if(empty($_SESSION['usuarioNiveisAcessoId'])){
        ?><SCRIPT Language="javascript">
           alert('Efetue o login para acessar');
           location.href="/painel/index.php";
           </SCRIPT>
        <?
    }
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<div class="menu-container">
    <ul class="menu clearfix">
        <li><a href="/painel/colaborador.php">Home</a></li>        
        <li><a href="/painel/usuarios/relatorio.php">Relatórios</a></li>
        <li><a href="/painel/cadastro/usuario.php"><?php echo " ". $_SESSION['usuarioNome'] ?></a>
            <ul class="sub-menu clearfix">
                <li><a href="/painel/sair.php">Sair</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
</html>