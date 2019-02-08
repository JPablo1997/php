<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Add New Joke</title>
</head>
<body>
	<h1>Add New Joke</h1>
	<form action="index.php" method="POST">
		<div>
			<label for="author">Author:</label>
			<select name="author" id="author">
				<option value="">Any author</option>
				<?php foreach ($authors as $author):?>
					<option value="<?php  echo $author['id'];?>"><?php  echo $author['name'];?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			
			<?php foreach ($categories as $category):?>
				<label for="category<?php  echo $category['id'];?>"><input id="category<?php  echo $category['id'];?>" type="checkbox" name="categories[]" value="<?php  echo $category['id'];?>"><?php  echo $category['name'];?></label>
			<?php endforeach; ?>
		</div>
		<div>
			<label for="text">Joke text:</label>
			<input type="text" name="text" id="text">
		</div>
		<div>
			<input type="submit" name="action" value="Save">
		</div>
	</form>
</body>
</html>