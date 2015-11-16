<?php
// BANCO DE DADOS
function connect() {
	$host = 'localhost';
	$db_name = 'csv_import_export';
	$db_user = 'root';
	$db_password = '';
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$data = date('Ymd');

// PARAMETROS CONFIGURAVEIS

$banco = '756';
$cooperativa = '3027';
$espaco_meio = '               00000000000            ';
$descricao = 'UNIMED11  ';
$espaco_final = '                                                                        ';
?>