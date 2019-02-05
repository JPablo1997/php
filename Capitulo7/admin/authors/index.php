<?php 

	include '../../../includes/db.inc.php';

	if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
		
		$authorid = $_POST['id'];

		try {
			$sql = 'SELECT id FROM joke WHERE authorid = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id',$authorid);
			$s->execute();
			
		} catch (PDOException $e) {
			$error = 'Error fetching jokes for author to be delete.';
			include 'error.html.php';
			exit();	
		}

		$result = $s->fetchAll();

		try {
			$sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
			$s = $pdo->prepare($sql);

			foreach ($result as $joke) {
				$jokeid = $joke['id'];
				$s->bindValue(':id', $jokeid);
				$s->execute();				
			}	
		} catch (PDOException $e) {
			$error = 'Error deleting category entries for joke.';
			include 'error.html.php';
			exit();
		}
		

		
		try {
			$sql = 'DELETE FROM joke WHERE authorid = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $authorid);
			$s->execute();				
		} catch (PDOException $e) {
			$error = 'Error deleting jokes.';
			include 'error.html.php';
			exit();	
		}


		try {
			$sql = 'DELETE FROM author WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $authorid);
			$s->execute();
		} catch (PDOException $e) {
			$error = 'Error deleting author.';
			include 'error.html.php';
			exit();
		}
		
	}

	try {
		$result = $pdo->query('SELECT id, name FROM author');
	} catch (PDOException $e) {
		$error = 'Error fetching authors from the db!';
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row ) {
		$authors[]  = array('id' => $row['id'], 'name' => $row['name']);
	}

	include 'authors.html.php';


 ?>