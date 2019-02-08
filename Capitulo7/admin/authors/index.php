<?php 

	include '../../../includes/db.inc.php';

	if (isset($_GET['add'])) {

		$pageTitle = 'New Author';
		$action = 'addform';
		$button = 'Add Author';
		$name = '';
		$email = '';
		$id = '';

		include 'form.html.php';
		exit();
	}

	if (isset($_GET['addform'])) {
		if (isset($_POST['name']) and isset($_POST['email'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];

			try {
				$sql = 'INSERT INTO author (id, name, email) VALUES(null, :name, :email)';
				$s = $pdo->prepare($sql);
				$s->bindValue(':name', $name);
				$s->bindValue(':email', $email);
				$s->execute();
			} catch (PDOException $e) {
				$error = 'Error adding new author.';
				include 'error.html.php';
				exit();
			}
		}
	}
	if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
		
		$id = $_POST['id'];

		try {
			$sql = 'SELECT name, email FROM author WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $id);
			$s->execute();
			$author = $s->fetch();
			$name = $author['name'];
			$email = $author['email'];
			$pageTitle = 'Edit Author';
			$action = 'editform';
			$button = 'Update Author';
			$id = $_POST['id'];

			include 'form.html.php';
			exit();

		} catch (PDOException $e) {
			$error = 'Error finding author to be Edit.';
			include 'error.html.php';
			exit();
		}
	}

	if (isset($_GET['editform'])) {
		try {
			$sql = 'UPDATE author SET name = :name, email = :email WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->bindValue(':email', $_POST['email']);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();

		} catch (PDOException $e) {
			$error = 'Error editing author.';
			include 'error.html.php';
			exit();
		}
		header('Location: .');
		exit();
	}

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