<?php 	
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ijdb','pablo','21001diaz$');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	} catch (PDOException $e) {
		$error = 'Unable to connect to the db server.';
		include 'error.html.php';
		exit();
	}
?>
