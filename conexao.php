<?php
    $servidor = "SERVIDOR";
    $usuario = "USUARIO";
    $senha = "SENHA";
    $dbname = "NOME-DO-BANCO";
    
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    }else{
        //echo "Conexao realizada com sucesso";
    }      
?>