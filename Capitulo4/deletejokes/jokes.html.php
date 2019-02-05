<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List of jokes</title>
</head>
<body>
	<a href="../insertjokes/">Add your own jokes!</a>
	<p>Here are all the jokes in the database:</p>
	<table>
			<thead>
				<tr>
					<th>Joke</th>
					<th>Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($jokes as $joke): ?>
				<tr>
					<td>
						<blockquote>
							<p>
								<?php echo htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8'); ?>
							</p>
						</blockquote>
					</td>
					<td>
						<blockquote>
							<p>
								<?php echo htmlspecialchars($joke['jokedate'], ENT_QUOTES, 'UTF-8'); ?>
							</p>
						</blockquote>
					</td>
					<td>
						<form action="" method="POST">
							<input type="text" name="del<?php echo $joke['id']; ?>" value="<?php echo $joke['id']; ?>" style="display: none;">
							<input type="submit" style="color: white; background-color: red;" name="btnDelete" value="Delete">
						</form>
					</td>
				</tr>
	<?php endforeach ?>
			</tbody>
	</table>
</body>
</html>