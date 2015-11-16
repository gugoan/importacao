<?php
// ARQUIVO DE CONFIGURAÇÃO
include('config.php');
$pdo = connect();

$STH_SELECT = $pdo->query("SELECT sum(valor) FROM lista");
$sum = $STH_SELECT->fetchColumn();

// INICIO CONFIGURAÇÃO CABEÇALHO PARA FORÇAR DOWNLOAD EM TXT
header('Content-Type:text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename=importar.txt');


// INICIO CABEÇALHO 
$output = "0175630270094579UNIMED    4103$data                                                                                                                                                                  \r\n";

$sql = 'SELECT * FROM lista ORDER BY id ASC';
$query = $pdo->prepare($sql);
$query->execute();
$count = $query->rowCount();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// LINHA POR LINHA
    $output .= "1D"
    .$rs['conta'].""
    .str_pad($rs['nome'], 40).""
    .$rs['cpf'].""
    .$espaco_meio.""
    .$descricao.""
    .$rs['valor'].""
    .$espaco_final."\r\n";
}

// INICIO RODAPE

$count = str_pad($count, 5, "0", STR_PAD_LEFT);
$sum   = str_pad($sum, 17, "0", STR_PAD_LEFT);
$output .= "9".$count.$sum."0000000000000000000000                                                                                                                                                           ";

// EXPORTA O ARQUIVO
echo $output;
exit;
?>


