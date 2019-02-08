<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Categories CMS</title>
</head>
<body>
	<h1>Manage Catergories</h1>
	<h3><a href="?add">Add Category</a></h3>
	<ul><table>
		<thead>
			<tr>
				<th>Category name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<?php foreach($categories as $category):  ?>	
				<tr><td><li><?php echo htmlspecialchars($category['name']); ?></li></td>
				<td><form method="POST">
					<input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']);?>">
					<input type="hidden" name="name_edit" value="<?php echo htmlspecialchars($category['name']);?>">
					<input style="background-color: gray;color: white;" type="submit" name="action" value="Edit">
					<input id="delete<?php echo($category['id']) ?>" style ="background-color: red;color: white; display: none" type="submit" name="action" value="Delete">
					<input style ="background-color: red;color: white;" type="button" name="action" value="Delete" onclick="delete_category('<?php echo($category['id']) ?>', '<?php echo($category['name']) ?>');">
				</form></td></tr>
		<?php endforeach ?>
	</table></ul>
</body>
<script type="text/javascript">
	function delete_category(categoryid, categoryname) {
		result = window.confirm('Are you sure of delete category '+categoryname+'?');
		if (result) {
			document.getElementById('delete'+categoryid).click();
		}
	}
</script>
</html>