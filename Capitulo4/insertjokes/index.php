<?php 

	if (!isset($_REQUEST['joketext'])) {
		include 'formJokes.html.php';
		exit();		
	}

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ijdb','pablo','21001diaz$');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	} catch (PDOException $e) {
		$error = 'Unable to connect to the db server.';
		include 'error.html.php';
		exit();
	}

	if (isset($_REQUEST['joketext'])) {

		$joketext = $_REQUEST['joketext'];
		$jokedate = $_REQUEST['jokedate'];

		try {
			
			$sql = "INSERT INTO joke VALUES(null,'".$joketext."','".$jokedate."') ";
			$affectedRows = $pdo->query($sql);
			
		} catch (PDOException $e) {
			$error = 'Unable to insert joke into the db: '. $e->getMessage();
			include 'error.html.php';
			exit();
		}

		include '../listjokes/index.php';

	}else{

		include 'formJokes.html.php';
	}


 ?>