<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Edit Joke</title>
</head>
<body>
	<h1>Edit joke</h1>	
	<form action="index.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $joke['id'];?>">
		<div>
			<label for="author">Author:</label>
			<select name="author" id="author">
				<option value="">Any author</option>
				<?php foreach ($authors as $author):?>
					<?php  if($author['selected']): ?>
						<option value="<?php  echo $author['id'];?>" selected><?php  echo $author['name'];?></option>
					<?php  endif; ?>
					<?php  if(!$author['selected']): ?>
						<option value="<?php  echo $author['id'];?>"><?php  echo $author['name'];?></option>
					<?php  endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			
			<?php foreach ($categories as $category):?>
				<?php if($category['selected']):?>
					<label for="category<?php  echo $category['id'];?>"><input id="category<?php  echo $category['id'];?>" type="checkbox" name="categories[]" value="<?php  echo $category['id'];?>" checked><?php  echo $category['name'];?></label>
				<?php endif; ?>
				<?php if(!$category['selected']):?>
					<label for="category<?php  echo $category['id'];?>"><input id="category<?php  echo $category['id'];?>" type="checkbox" name="categories[]" value="<?php  echo $category['id'];?>"><?php  echo $category['name'];?></label>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div>
			<label for="text">Joke text:</label>
			<input type="text" name="text" id="text" value="<?php  echo $joke['joketext'];?>">
		</div>
		<div>
			<input type="submit" name="action" value="Update">
		</div>
	</form>
</body>
</html>