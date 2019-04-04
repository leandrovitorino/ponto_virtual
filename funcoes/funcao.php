<?php 

	function soma_hora($entrada, $saida){

		$hora1 = explode(":",$entrada);
		$hora2 = explode(":",$saida);
		$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
		$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
		$resultado = $acumulador2 + $acumulador1;
		$hora_ponto = intval($resultado / 3600);
		$resultado = $resultado - ($hora_ponto * 3600);
		$min_ponto = intval($resultado / 60);
		$resultado = $resultado - ($min_ponto * 60);
		$secs_ponto = $resultado;
		//Grava na variável resultado final
		if ($hora_ponto < 0){
			$hora_ponto = $hora_ponto * -1;
		}
		if ($min_ponto < 0){
			$min_ponto = $min_ponto * -1;
		}
		if ($secs_ponto < 0){
			$secs_ponto = $secs_ponto * -1;
		}
		$tempo = "0".$hora_ponto.":";
		if ($min_ponto < 10){
			$tempo .= "0".$min_ponto.":";
		}else{
			$tempo .= $min_ponto.":";
		}
		if ($secs_ponto < 10){
			$tempo .= "0".$secs_ponto;
		}else{
			$tempo .= $secs_ponto;
		}

		return $tempo;
	}

	function sub_hora($entrada, $saida){

		$hora1 = explode(":",$entrada);
		$hora2 = explode(":",$saida);
		$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
		$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
		$resultado = $acumulador2 - $acumulador1;
		$hora_ponto = intval($resultado / 3600);
		$resultado = $resultado - ($hora_ponto * 3600);
		$min_ponto = intval($resultado / 60);
		$resultado = $resultado - ($min_ponto * 60);
		$secs_ponto = $resultado;
		//Grava na variável resultado final
		if ($hora_ponto < 0){
			$hora_ponto = $hora_ponto * -1;
		}
		if ($min_ponto < 0){
			$min_ponto = $min_ponto * -1;
		}
		if ($secs_ponto < 0){
			$secs_ponto = $secs_ponto * -1;
		}
		$tempo = "0".$hora_ponto.":";
		if ($min_ponto < 10){
			$tempo .= "0".$min_ponto.":";
		}else{
			$tempo .= $min_ponto.":";
		}
		if ($secs_ponto < 10){
			$tempo .= "0".$secs_ponto;
		}else{
			$tempo .= $secs_ponto;
		}

		if ($acumulador1 > $acumulador2){
			$_SESSION['extra'] = $tempo;
		}else{
			$_SESSION['atraso'] = $tempo;
		}

		return $tempo;
	}

	function dif_hora($entrada, $saida){

		$hora1 = explode(":",$entrada);
		$hora2 = explode(":",$saida);
		$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
		$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
		$resultado = $acumulador2 - $acumulador1;
		$hora_ponto = intval($resultado / 3600);
		$resultado = $resultado - ($hora_ponto * 3600);
		$min_ponto = intval($resultado / 60);
		$resultado = $resultado - ($min_ponto * 60);
		$secs_ponto = $resultado;
		//Grava na variável resultado final
		if ($hora_ponto < 0){
			$hora_ponto = $hora_ponto * -1;
		}
		if ($min_ponto < 0){
			$min_ponto = $min_ponto * -1;
		}
		if ($secs_ponto < 0){
			$secs_ponto = $secs_ponto * -1;
		}
		$tempo = "0".$hora_ponto.":";
		if ($min_ponto < 10){
			$tempo .= "0".$min_ponto.":";
		}else{
			$tempo .= $min_ponto.":";
		}
		if ($secs_ponto < 10){
			$tempo .= "0".$secs_ponto;
		}else{
			$tempo .= $secs_ponto;
		}
		return $tempo;

	}

	function calc_horas($entrada, $saida){

		$hora1 = explode(":",$entrada);
		$hora2 = explode(":",$saida);
		$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
		$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
		$resultado = $acumulador2 - $acumulador1;
		$hora_ponto = intval($resultado / 3600);
		$resultado = $resultado - ($hora_ponto * 3600);
		$min_ponto = intval($resultado / 60);
		$resultado = $resultado - ($min_ponto * 60);
		$secs_ponto = $resultado;
		//Grava na variável resultado final
		if ($hora_ponto < 0){
			$hora_ponto = $hora_ponto * -1;
		}
		if ($min_ponto < 0){
			$min_ponto = $min_ponto * -1;
		}
		if ($secs_ponto < 0){
			$secs_ponto = $secs_ponto * -1;
		}
		$tempo = "0".$hora_ponto.":";
		if ($min_ponto < 10){
			$tempo .= "0".$min_ponto.":";
		}else{
			$tempo .= $min_ponto.":";
		}
		if ($secs_ponto < 10){
			$tempo .= "0".$secs_ponto;
		}else{
			$tempo .= $secs_ponto;
		}
		if ($acumulador1 >= $acumulador2){
			$_SESSION['extra'] = $tempo;
		}else{
			$_SESSION['atraso'] = $tempo;
		}
	}

	function intervalo($entrada, $saida, $conn){

		$zero = "00:00:00";
		$dia = date("d/m/Y");
		$hora1 = explode(":",$entrada);
		$hora2 = explode(":",$saida);
		$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
		$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
		$resultado = $acumulador1 - $acumulador2;
		$hora_ponto = intval($resultado / 3600);
		$resultado = $resultado - ($hora_ponto * 3600);
		$min_ponto = intval($resultado / 60);
		$resultado = $resultado - ($min_ponto * 60);
		$secs_ponto = $resultado;
		//Grava na variável resultado final
		if ($hora_ponto < 0){
			$hora_ponto = $hora_ponto * -1;
		}
		if ($min_ponto < 0){
			$min_ponto = $min_ponto * -1;
		}
		if ($secs_ponto < 0){
			$secs_ponto = $secs_ponto * -1;
		}
		$tempo = "0".$hora_ponto.":";
		if ($min_ponto < 10){
			$tempo .= "0".$min_ponto.":";
		}else{
			$tempo .= $min_ponto.":";
		}
		if ($secs_ponto < 10){
			$tempo .= "0".$secs_ponto;
		}else{
			$tempo .= $secs_ponto;
		}

		if ($acumulador1 > $acumulador2){
			$sql = "UPDATE relatorio SET atraso = '$tempo' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
			$query = mysqli_query($conn, $sql);
		}else{
			$sql = "UPDATE relatorio SET atraso = '$zero' WHERE data = '$dia' && id = '$_SESSION[usuarioId]'";
			$query = mysqli_query($conn, $sql);
		}
	}

	function senha(){
		$caracteres = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@&";
		$mistura = substr(str_shuffle($caracteres),0,10);
		return $mistura;
	}

 ?>