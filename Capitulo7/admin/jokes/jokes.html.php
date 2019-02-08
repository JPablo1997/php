<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List of jokes</title>
</head>
<body>
	<h1>Jokes found</h1>
	<table>
		<thead>
			<tr>
				<th>Jokes</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($jokes as $joke):?>
				<tr>
					<form method="POST" action=".">
						<td>
							<?php echo $joke['joketext']; ?>
						</td>
						<td>
							<input type="hidden" name="id" value="<?php echo $joke['id']; ?>">
							<input style="background-color: green; color: white; width: 70px;" type="submit" name="action" value="Edit">
							<input style="background-color: red; color: white; width: 70px;" type="button" value="Delete" onclick="delete_joke('<?php echo $joke['id']; ?>')">
							<input type="submit" name="action" value="Delete" id="delete<?php echo $joke['id']; ?>" style="display: none;">
						</td>
					</form>
				</tr>
			<?php endforeach; ?>	
		</tbody>
	</table>
</body>
<script type="text/javascript">
	function delete_joke(id) {
		var resp = confirm('Are you sure to delete this joke?');
		if (resp) {
			document.getElementById('delete'+id).click();
		}
	}
</script>
</html>