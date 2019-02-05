<?php 

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ijdb','pablo','21001diaz$');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');

		$sql = 'UPDATE joke SET jokedate = "2018-04-01" WHERE joketext LIKE "%chicken%"';
		$affectedRows = $pdo->exec($sql);
	} catch (PDOException $e) {
		$output = 'Error perfoming update: '. $e.getMessage();
		include 'output.html.php';
		exit();
	}

	$output = 'Updated '.$affectedRows.' rows.';
	include 'output.html.php';

 ?>