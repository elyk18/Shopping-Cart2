<?php 

	include ("../html/database-connection.php");

	session_start();

	$customers_id = $_SESSION['id'];

	$connection = new PDO("$database_type:host=$host;dbname=$database_name", $database_username, $database_password);
	$sql_query_load_products_from_cart = "SELECT * FROM products INNER JOIN cart_products on products.id = cart_products.product_id INNER JOIN carts ON carts.id = cart_products.cart_id INNER JOIN customers on customers.id = carts.customer_id WHERE customers.id = '$customers_id'";

	$total_price = 0;


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" type="text/css" href="../style/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../script/script.js"></script>
</head>
<body>

<h1>Logged in as <strong><?php print $_SESSION['fullname']; ?></strong></h1>
<a href="../html/logout.php">Log Out</a>

<div class="center-horizontal vertical-25">

	<div>
		<?php foreach($connection -> query($sql_query_load_products_from_cart) as $product): ?>
			<h1><?php print $product['product_name'] . "\t"; ?>
			<?php print $product['product_description'] . "\t"; ?>
			<?php print $product['product_price'] . "\t"; ?>
			<?php print $product['product_quantity'] . "\t"; ?>
			<?php $param = $product['product_id'] . ", " . $product['product_price']; ?>

			</h1>
			
		<?php endforeach; ?>
	</div>
	<hr>
	<h4 id="total"><?php 

		$total = 0;
		foreach($connection -> query($sql_query_load_products_from_cart) as $product) {
			$total += $product['product_price'];
		}

		print $total;

	 ?></h4>
	 <a href="../html/invoice.php">Proceed to Checkout</a>
	 <br>
	<a href="../html/shopping-cart.php">Continue Shopping</a>
</div>


</body>
</html>