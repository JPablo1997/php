<?php 

	include '../connect/db.inc.php';

	try {
		$sql = 'SELECT * FROM joke';
		$result = $pdo->query($sql);
	} catch (Exception $e) {
		$error = 'Error fetching jokes: ' . $e->getMessage();
		include 'error.html.php';
		exit();	
	}

	while ($row = $result->fetch()) {
		$jokes[] = $row;
	}

	foreach ($jokes as $joke) {
		
		if (isset($_POST['del'.$joke['id']])) {
			
			$idjoke = $_POST['del'.$joke['id']];

			try {
				$sql = 'DELETE FROM joke WHERE id = '.$idjoke;
				$result = $pdo->query($sql);
				header('location: .');
			} catch (Exception $e) {
				$error = 'Error deleting joke: ' . $e->getMessage();
				include 'error.html.php';
				exit();	
			}			
		}
	}

	include 'jokes.html.php';
 ?>
