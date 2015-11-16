<?php 
// including the config file
include('config.php');
$pdo = connect();

// clear table before import
$pdo->exec("TRUNCATE TABLE lista");

$csv_file =  $_FILES['csv_file']['tmp_name'];
if (is_file($csv_file)) {
	$input = fopen($csv_file, 'a+');
	// if the csv file contain the table header leave this line
	$row = fgetcsv($input, 1024, ';'); // here you got the header
	while ($row = fgetcsv($input, 1024, ';')) {
		// check and fix values

		// remove . and -
		$rem   = array("-", ".", ",", "'");

		//upper all characters
		$nome = strtoupper($row[1]); 
		$nome = str_replace($rem, '', $nome);

		$cpf = str_replace($rem, '', $row[2]);
		$conta = str_replace($rem, '', $row[3]);
		$valor = str_replace($rem, '', $row[4]);

		// insert into the database		
		$sql = 'INSERT INTO lista(nome, cpf, conta, valor) VALUES(:nome, :cpf, :conta, :valor)';
		$query = $pdo->prepare($sql);
		$query->bindParam(':nome', $nome, PDO::PARAM_STR);
		$query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
		$query->bindParam(':conta', $conta, PDO::PARAM_STR);
		$query->bindParam(':valor', $valor, PDO::PARAM_INT);
		$query->execute();
	}
}

// redirect to the index page
header('location: index.php');
?>


