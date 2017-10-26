<?php 

	include ("../html/database-connection.php");

	// $field_checker = true;

	// foreach($_POST as $product_info) {
	// 	if(empty($product_info)) {
	// 		$field_checker = false;
	// 	}else {
	// 		print "Database Error! Some field is null!";
	// 	}
	// }

	$connection = new PDO("$database_type:host=$host;dbname=$database_name", $database_username, $database_password);
	$sql_query_cart_status = $connection -> prepare("SELECT id FROM carts WHERE cart_status = TRUE");
	$sql_query_cart_status -> execute();
    $cart_status = $sql_query_cart_status -> fetch();

    if(isset($cart_status['id'])) {

    	$product_id = $_POST['product_id'];
    	$product_id_checker = $connection -> prepare("SELECT product_id FROM cart_products WHERE product_id = '$product_id'");
    	$product_id_checker -> execute();
    	$product_id_checker_result = $product_id_checker -> fetch();

    	if($product_id_checker_result['product_id'] == $_POST['product_id']) {
    		session_start();
    		$_SESSION['catalog_notification'] = "Item is already on the Cart!";
    		header("Location: ../html/digital-catalog.php");
    	}else {
    		$cart_id = $cart_status['id'];
    		$sql_query_add_item = $connection -> prepare("INSERT INTO cart_products(cart_id, product_id, product_quantity) VALUE('$cart_id', '$product_id', 1)");
    		$sql_query_add_item -> execute();
    		session_start();
    		$_SESSION['catalog_notification'] = "Item successfully added to Cart!";
    		header("Location: ../html/digital-catalog.php");
    	}

    }else {
        session_start();

        $customers_id = $_SESSION['id'];

    	$sql_query_new_cart = $connection -> prepare("INSERT INTO carts(customer_id, cart_status) VALUE('$customers_id', TRUE");
    	$sql_query_new_cart -> execute();

    	$cart_id = $cart_status['id'];
    	$product_id = $_POST['product_id'];
    	$product_quantity = 1;

    	$sql_query_cart_item = $connection -> prepare("INSERT INTO cart_products(cart_id, product_id, product_quantity) VALUE('$cart_id', '$product_id', '$product_quantity')");
    	$sql_query_cart_item -> execute();

    }
 ?>