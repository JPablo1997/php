<?php 
	include '../../../includes/db.inc.php';

	if (isset($_GET['add'])) {
		header('Location: addcategory.html');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Save') {
		try {
			$sql = 'INSERT INTO category(id, name) VALUES (null, :name)';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->execute();
			header('Location: index.php');
			exit();
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
		try {
			$sql = 'DELETE FROM jokecategory WHERE categoryid = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();

		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		try {
			$sql = 'DELETE FROM category WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
			header('Location: .');

		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
		$name = $_POST['name_edit'];
		$id = $_POST['id'];
		include 'editcategory.html.php';
		exit();
	} 

	if (isset($_POST['action']) and $_POST['action'] == 'Update') {
		$name = $_POST['name'];
		$id = $_POST['id'];
		
		try {

			$sql = 'UPDATE category SET name = :name WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $id);
			$s->bindValue(':name', $name);
			$s->execute();
			header('Location: index.php');
			exit();
			
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}

	try {
		$sql = 'SELECT * FROM category';
		$s = $pdo->prepare($sql);
		$s->execute();
		$categories = $s->fetchAll();
		include 'categories.html.php';
		exit();
	} catch (PDOException $e) {
		$error = 'Error fetching categories.';
		include 'error.html.php';
		exit();
	}
 ?>