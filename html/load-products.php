<?php 

	$connection = new PDO("$database_type:host=$host;dbname=$database_name", $database_username, $database_password);
	$sql_query_load_catalog = "SELECT * FROM products";

 ?>