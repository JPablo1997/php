<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Category</title>
</head>
<body>
	<h1>Edit Category</h1>
	<form action="index.php" method="POST">
		<input type="hidden" name="id" value="<?php echo($id); ?>">
		<label for="name">Name category: <input id="name" type="text" name="name" value="<?php echo($name); ?>"></label><br><br>
		<input type="submit" name="action" value="Update">
		<input type="button" value="Cancel" onclick="location.href='index.php';">
	</form>
</body>
</html>