<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Authors CMS</title>
</head>
<body style="margin-left: 650px;">
	<h1>Manage Authors</h1>
	<p><a href="?add">Add new author</a></p>
	<table>
		<thead>
			<tr>
				<th style="width: 200px;">Author</th>
				<th style="width: 200px;">Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($authors as $author):  ?>
			<tr>
				<form action="" method="POST">
					<div>
						<td>
							<label><?php echo htmlspecialchars($author['name']); ?></label>
							<input type="hidden" name="id" value="<?php echo $author['id']; ?>">
						</td>
						<td style="text-align: center;">
							<input style="background-color: gray;color: white;" type="submit" name="action" value="Edit">
							<input style ="background-color: red;color: white; display: none;" id="delete<?php echo $author['id']; ?>" type="submit" name="action" value="Delete">
							<input style ="background-color: red;color: white;" type="button" name="action" value="Delete" onclick="eliminar_autor('<?php echo $author['id']; ?>','<?php echo $author['name']; ?>');">
						</td>
					</div>
				</form>
			</tr>
		</tbody>
		<?php endforeach; ?>
	</table>
	<p><a href="..">Return to JMS home</a></p>
</body>
<script type="text/javascript">
	function eliminar_autor(authorid, authorname) {
		result = window.confirm('Are you sure of delete author '+authorname+'?');
		if (result) {
			document.getElementById('delete'+authorid).click();
		}
	}
</script>
</html>