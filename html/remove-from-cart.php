<?php 

	include ("../html/database-connection.php");
	$product_id = $_POST['product_id'];
	$connection = new PDO("$database_type:host=$host;dbname=$database_name", $database_username, $database_password);
	$sql_query_remove_product = $connection -> prepare("DELETE FROM cart_products WHERE product_id = '$product_id'");
	$sql_query_remove_product -> execute();
	header("Location: ../html/shopping-cart.php")

 ?>