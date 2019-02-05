<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List of jokes</title>
</head>
<body>
	<a href="../insertjokes/">Add your own jokes!</a>
	<p>Here are all the jokes in the database:</p>
	<?php foreach ($jokes as $joke): ?>
		<blockquote>
			<p>
				<?php echo htmlspecialchars($joke, ENT_QUOTES, 'UTF-8'); ?>
			</p>
		</blockquote>
	<?php endforeach ?>
</body>
</html>