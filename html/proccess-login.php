<?php 

	include ("../html/database-connection.php");

	$username = $_POST["username"];
	$password = $_POST["password"];

	if(!empty($username) && !empty($password)) {

		$connection = new PDO("$database_type:host=$host;dbname=$database_name", $database_username, $database_password);
	    $sql_query = $connection -> prepare("SELECT username, password FROM customers WHERE username = '$username' AND password = '$password'");
	    $sql_query -> execute();

	    $result = $sql_query -> fetch();

	    if(!empty($result['username']) && !empty($result['password'])) {
	    	session_start();
	    	
	    	$sql_query_fetch_user = $connection -> prepare("SELECT * FROM customers WHERE username = '$username' AND password = '$password'");
	   		$sql_query_fetch_user -> execute();
	   		$user_info = $sql_query_fetch_user -> fetch();

			$_SESSION['username'] = $username;
	    	$_SESSION['password'] = $password;
	   		$_SESSION['id'] = $user_info['id'];
	    	$_SESSION['fullname'] = $user_info['customer_name'];
	    	$_SESSION['address'] = $user_info['customer_address'];
	    	$_SESSION['balance'] = $user_info['customer_balance'];
	    	header('Location: ../html/digital-catalog.php');

	    }else {
	    	session_start();
	    	$_SESSION['login_result'] = "Incorrect Username or Password!";
    		header("Location: ../index.php");
	    }
	}else {
		session_start();
    	$_SESSION['login_result'] = "Please fill all the input field!";
		header("Location: ../index.php");
	}
	
 ?>