<?php	
	session_start();
	include_once("../conexao.php");

	if(empty($_SESSION['usuarioNiveisAcessoId'])){
        ?><SCRIPT Language="javascript">
           alert('Efetue o login para acessar');
           location.href="painel/sair.php";
           </SCRIPT>
        <?
    }else if($_SESSION['usuarioNiveisAcessoId'] != 1){
        header("Location: painel/colaborador.php");
    }

	if(!empty($_SESSION['DI'])){
		$DI=$_SESSION['DI'];
	}else{
		$DI=date('01/m/Y');
	}
	if(!empty($_SESSION['DF'])){
		$DF=$_SESSION['DF'];
	}else{
		$DF=date('d/m/Y');
	}

	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Nome</th>';
	$html .= '<th>Data</th>';
	$html .= '<th>Entrada</th>';
	$html .= '<th>Intervalo</th>';
	$html .= '<th>Volta</th>';
	$html .= '<th>Saída</th>';
	$html .= '<th>Extras</th>';
	$html .= '<th>Atrasos</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	if (isset($_SESSION['selectoption']) && !empty($_SESSION['selectoption'])){
	//$result_transacoes = "SELECT * FROM relatorio WHERE nome = '$_SESSION[selectoption]' && '$DI' <= data AND 'DF' >= data ORDER BY data DESC";
		$result_transacoes = "SELECT * FROM relatorio WHERE nome = '$_SESSION[selectoption]' && STR_TO_DATE(data, '%d/%m/%Y') BETWEEN '$DI' and '$DF' ORDER BY id_relatorio DESC";
	}else{
	//$result_transacoes = "SELECT * FROM relatorio WHERE '$DI' <= data AND 'DF' >= data ORDER BY data DESC";
		$result_transacoes = "SELECT * FROM relatorio WHERE STR_TO_DATE(data, '%d/%m/%Y') BETWEEN '$DI' and '$DF' ORDER BY id_relatorio DESC";
	}
	$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['nome'] . "</td>";
		$html .= '<td>'.$row_transacoes['data'] . "</td>";
		$html .= '<td>'.$row_transacoes['ent1'] . "</td>";
		$html .= '<td>'.$row_transacoes['sai1'] . "</td>";
		$html .= '<td>'.$row_transacoes['ent2'] . "</td>";
		$html .= '<td>'.$row_transacoes['sai2'] . "</td>";
		$html .= '<td>'.$row_transacoes['horas'] . "</td>";
		$html .= '<td>'.$row_transacoes['atraso'] . "</td></tr>";		
	}
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('
			<p align="center"><img src="images/digirati.png"> <br>'. $html .'</p><br><br><br><br> '.$_SESSION['selectoption'].': ______________________________________ <br><br> Meirielle Alves: ______________________________________');


	//Renderizar o html
	$dompdf->render();

	//Exibir a página
	$dompdf->stream(
		"relatorio_pontos.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
	mysqli_close($conn);
?>