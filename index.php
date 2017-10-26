<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./style/style.css">
	<link rel="stylesheet" type="text/css" href="./style/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
</head>
<body>
<div class="center-horizontal vertical-25">

	<?php 

		session_start();
		if(isset($_SESSION['login_result'])) {
			print $_SESSION['login_result'];
			session_unset($_SESSION['login_result']);
		}elseif(isset($_SESSION['username'])) {
			header("Location: ./html/digital-catalog.php");
		}
		
	 ?>

	<form action="./html/proccess-login.php" method="post">
		Username
		<input type="text" name="username">
		<br>
		Password
		<input type="password" name="password">
		<br>
		<button type="submit">login</button>
		<a href="./html/register.php">register</a>
	</form>
</div>
	
</body>
</html>