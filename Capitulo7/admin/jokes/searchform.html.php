<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Manage Jokes</title>
</head>
<body>
	<h1>Manage Jokes</h1>
	<p><a href="?add">Add new joke</a></p>
	<form action="" method="GET">
		<p>View jokes satisfying the following criteria:</p>
		<div>
			<label for="author">By author:</label>
			<select name="author" id="author">
				<option value="">Any author</option>
				<?php foreach ($authors as $author):?>
					<option value="<?php  echo $author['id'];?>"><?php  echo $author['name'];?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label for="category">By category:</label>
			<select name="category" id="category">
				<option value="">Any category</option>
				<?php foreach ($categories as $category):?>
					<option value="<?php  echo $category['id'];?>"><?php  echo $category['name'];?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label for="text">Containing text:</label>
			<input type="text" name="text" id="text">
		</div>
		<div>
			<input type="hidden" name="action" value="search">
			<input type="submit" value="Search">
		</div>
	</form>
	<p><a href="..">Return to JMS home</a></p>
</body>
</html>