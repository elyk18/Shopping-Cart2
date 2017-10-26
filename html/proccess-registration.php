<?php 

	include ("../html/database-connection.php");

	$fullname = $_POST['fullname'];
	$address = $_POST['address'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$balance = $_POST['balance'];
	$field_checker = true;

	foreach ($_POST as $field) {
		if(empty($field)) {
			$field_checker = false;
		}
	}

	if($field_checker == true) {

		if($password != $confirm_password) {
			session_start();
	    	$_SESSION['register_result'] = "Password doesn't match!";
    		header("Location: ../html/register.php");
		}else {

			$register_try = new PDO("$database_type:host=$host;dbname=$database_name", $database_username, $database_password);
		    $sql_query = $register_try -> prepare("SELECT username FROM customers WHERE username = '$username'");
		    $sql_query -> execute();

		    $result = $sql_query -> fetch();

		    if($result['username'] == $username) {
		    	session_start();
		    	$_SESSION['register_result'] = "Username already exist!";
				header("Location: ../html/register.php");
		    }else {
		    	$sql_register_query = $register_try -> prepare("INSERT INTO customers(username, password, customer_name, customer_address, customer_balance) VALUE ('$username', '$password', '$fullname', '$address', '$balance')");
		    	$sql_register_query -> execute();
		    	session_start();
		    	$_SESSION['register_result'] = $fullname . " is successfully registered! Login now!";
				header("Location: ../html/register.php");
		    }
		}

	}else {
		session_start();
    	$_SESSION['register_result'] = "Please fill all the input field!";
		header("Location: ../html/register.php");
	}

 ?>