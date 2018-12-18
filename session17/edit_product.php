<!DOCTYPE html>
<html>
<head>
	<title>Edit product</title>
</head>
<body>
	<?php include 'connect_db.php';?>
	<?php 
		$id = $_GET['idEdit'];
		// Lay thong tin cu cua san pham can edit theo ID
		$sql = "SELECT * FROM products WHERE id = $id";
		$oldProductEdit = mysqli_query($conn, $sql);
		$oldProduct = $oldProductEdit->fetch_assoc();
		$name        = $oldProduct['name'];
		$description = $oldProduct['description'];
		$price       = $oldProduct['price'];
		$status      = $oldProduct['status'];
		if (isset($_POST['edit_product'])) {
			$name        = $_POST['name'];
			$description = $_POST['description'];
			$price       = $_POST['price'];
			$status      = $_POST['status'];
			$sql = "UPDATE products SET name = '$name', description = '$description', price = $price, status = $status WHERE id = $id";
			if (mysqli_query($conn, $sql) === TRUE) {
				header("Location: list_product.php");
			}
		}
	?>
	<h1>Edit product</h1>
	<form action="#" method="POST" enctype="multipart/form-data">
		<p>Product name: <input type="text" name="name" placeholder="Please input product name" value="<?php echo $name?>"></p>
		<p>Product description: <textarea name="description" rows="10" cols="30"><?php echo $description?></textarea></p>
		<p>Product price: <input type="text" name="price" placeholder="Please input product price" value="<?php echo $price?>"></p>
		<p>Product image: <input type="file" name="image"></p>
		<p>Status:
			<input type="radio" name="status" value="1" <?php echo $status == 1?"checked":"";?>> Yes
			<input type="radio" name="status" value="0" <?php echo $status == 0?"checked":"";?>> No
		</p>
		<p><input type="submit" name="edit_product" value="Edit product"></p>
	</form>
</body>
</html>