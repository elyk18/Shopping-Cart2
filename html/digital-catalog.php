<?php 

	include ("../html/database-connection.php");
	include ("../html/load-products.php");

	session_start();

	if(!isset($_SESSION['username'])) {
		header("Location: ../index.php");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" type="text/css" href="../style/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
</head>
<body>
<h1>Logged in as <strong><?php print $_SESSION['fullname']; ?></strong></h1>
<a href="../html/logout.php">Log Out</a>
<div class="center-horizontal vertical-25">

	<?php 

		if(isset($_SESSION['catalog_notification'])) {
			print $_SESSION['catalog_notification'];
			$_SESSION['catalog_notification'] = "";
		}
		
	 ?>

	<div>
		<?php foreach($connection -> query($sql_query_load_catalog) as $product): ?>
			<h1><?php print $product['product_name'] . "\t"; ?>
			<?php print $product['product_description'] . "\t"; ?>
			<?php print $product['product_price'] . "\t"; ?>
			<?php print $product['product_stock'] . "\t"; ?></h1>
			<form action="proccess-add-product.php" method="post">
				<input type="hidden" name="product_id" value=<?php print $product['id']; ?>>
				<input type="hidden" name="product_name" value=<?php print $product['product_name']; ?>>
				<input type="hidden" name="product_description" value=<?php print $product['product_description']; ?>>
				<input type="hidden" name="product_price" value=<?php print $product['product_price']; ?>>
				<input type="hidden" name="product_stock" value=<?php print $product['product_stock']; ?>>
				<button type="submit">Add to Cart</button>
			</form>
		<?php endforeach; ?>
	</div>
	<a href="../html/shopping-cart.php">Show Cart</a>
</div>

</body>
</html>