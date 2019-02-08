<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo htmlspecialchars($pageTitle); ?></title>
</head>
<body>
	<h1><?php echo htmlspecialchars($pageTitle); ?></h1><br>
	<form action="?<?php echo htmlspecialchars($action); ?>" method="POST">
		<div>
			<label for="name">Name: <input id="name" type="text" name="name" value="<?php echo htmlspecialchars($name);?>"></label>
		</div><br>
		<div>
			<label for="email">Email: <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($email);?>"></label>
		</div><br>
		<div><br>
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
			<input type="submit" value="<?php echo htmlspecialchars($button); ?>">
		</div>
	</form>

</body>
</html>