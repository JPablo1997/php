<?php 

	include '../../../includes/db.inc.php';

	if (isset($_GET['action']) and $_GET['action'] == 'search') {
		$select = 'SELECT id, joketext';
		$from = ' FROM joke';
		$where = ' WHERE TRUE';

		$placeholders = array();

		if ($_GET['author'] != '') {
			$where .= ' AND authorid = :authorid';
			$placeholders[':authorid'] = $_GET['author']; 
		}

		if ($_GET['category'] != '') {
			$from .= ' INNER JOIN jokecategory ON id = jokeid';
			$where .= ' AND categoryid = :categoryid';
			$placeholders[':categoryid'] = $_GET['category'];
		}

		if ($_GET['text'] != '') {
			$where = ' AND joketext LIKE :joketext';
			$placeholders[':joketext'] = '%' .$_GET['text']. '%';
		}

		try {
			$sql = $select . $from . $where;
			$s = $pdo->prepare($sql);
			$s->execute($placeholders);
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();	
		}

		foreach ($s as $joke) {
			$jokes[] = array('id' => $joke['id'],'joketext' => $joke['joketext']);
		}

		include 'jokes.html.php';
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
		$jokeid = $_POST['id'];

		try {
			$sql = 'DELETE FROM jokecategory WHERE jokeid = :jokeid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':jokeid',$jokeid);
			$s->execute();

		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		try {
			$sql = 'DELETE FROM joke WHERE id = :jokeid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':jokeid',$jokeid);
			$s->execute();
			
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		header('Location: .');
		exit();
	}

	if (isset($_GET['add'])) {

		try {
			$result = $pdo->query('SELECT id, name FROM author');
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		foreach ($result as $row) {
			$authors[] =  array('id' => $row['id'] , 'name' => $row['name']);
		}

		try {
			$result = $pdo->query('SELECT id, name FROM category');
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		foreach ($result as $row) {
			$categories[] = array('id' => $row['id'], 'name' => $row['name']);
		}
		
		include 'addjoke.html.php';
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
		
		$jokeid = $_POST['id'];

		try {
			$sql = 'SELECT id, joketext, authorid FROM joke WHERE id = ' .$jokeid;
			$joke = $pdo->query($sql);
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		foreach ($joke as $row) {
			$joke = array('id' => $row['id'], 'joketext' => $row['joketext'], 'authorid' => $row['authorid']);
		}

		try {
			$result = $pdo->query('SELECT id, name FROM author');	
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();	
		}
		
		foreach ($result as $row) {
			$authors[] = array('id' => $row['id'] , 'name' =>  $row['name'], 'selected' => in_array($row['id'], $joke));
		}

		try {
			$sql = 'SELECT categoryid FROM jokecategory WHERE jokeid = ' .$jokeid;
			$result = $pdo->query($sql);
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();	
		}

		foreach ($result as $row) {
			$categories_selected[] = array('id' => $row['categoryid']);
		}

		try {
			$sql = 'SELECT id, name FROM category';
			$result = $pdo->query($sql);
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();	
		}

		foreach ($result as $row) {

			$selected = False;
			
			foreach ($categories_selected as $category_selected) {

				if (in_array($row['id'], $category_selected)) {
					$selected = True;
				}

			}

			$categories[] = array('id' => $row['id'], 'name' => $row['name'], 'selected' => $selected);
		}
		
		include 'editjoke.html.php';
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Update') {
		$id = $_POST['id'];
		$author = $_POST['author'];
		$joketext = $_POST['text'];

		try {
			$sql = 'UPDATE joke SET joketext = :joketext, authorid = :authorid WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':joketext', $joketext);
			$s->bindValue(':authorid', $author);
			$s->bindValue(':id', $id);
			$s->execute();
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();	
		}

		try {
			$sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $id);
			$s->execute();
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();
		}

		if (isset($_POST['categories'])) {
			try {
				$sql = 'INSERT INTO jokecategory (jokeid, categoryid) VALUES(:jokeid, :categoryid)';
				$s = $pdo->prepare($sql);

				foreach ($_POST['categories'] as $categoryid) {
					$s->bindValue(':jokeid', $id);
					$s->bindValue(':categoryid', $categoryid);
					$s->execute();
				}
			} catch (PDOException $e) {
				$error = $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}

	}
	if (isset($_POST['action']) and $_POST['action'] == 'Save') {
		$author = $_POST['author'];
		$category = $_POST['category'];
		$joketext = $_POST['text'];

		try {
			$sql = 'INSERT INTO joke (id, joketext, jokedate, authorid) VALUES(null, :joketext, now(), :authorid)';
			$s = $pdo->prepare($sql);
			$s->bindValue(':joketext', $joketext);
			$s->bindValue(':authorid', $author);
			$s->execute();
		} catch (PDOException $e) {
			$error = $e->getMessage();
			include 'error.html.php';
			exit();			
		}

		
		
		if (isset($_POST['categories'])) {

			$jokeid = $pdo->lastInsertId();

			try {

				$sql = 'INSERT INTO jokecategory(jokeid, categoryid) VALUES(:jokeid,:categoryid)';
				$s = $pdo->prepare($sql);

				foreach ($_POST['categories'] as $categoryid) {
					$s->bindValue(':jokeid',$jokeid);
					$s->bindValue(':categoryid',$categoryid);
					$s->execute();
				}
			} catch (PDOException $e) {
				$error = $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
	
	}
	try {
		$result = $pdo->query('SELECT id, name FROM author');
	} catch (PDOException $e) {
		$error = $e->getMessage();
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row) {
		$authors[] =  array('id' => $row['id'] , 'name' => $row['name']);
	}

	try {
		$result = $pdo->query('SELECT id, name FROM category');
	} catch (PDOException $e) {
		$error = $e->getMessage();
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row) {
		$categories[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	include 'searchform.html.php';

 ?>