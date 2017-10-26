<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" type="text/css" href="../style/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
</head>
<body>

	<div class="center-horizontal vertical-25">

		<?php 

			session_start();
			if(isset($_SESSION['register_result'])) {
				print $_SESSION['register_result'];
				session_unset($_SESSION['register_result']);
			}
			
		 ?>

		<form action="proccess-registration.php" method="post">
			Fullname
			<input type="text" name="fullname">
			<br>
			Address
			<input type="text" name="address">
			<br>
			Username
			<input type="text" name="username">
			<br>
			Password
			<input type="password" name="password">
			<br>
			Confirm-Password
			<input type="password" name="confirm_password">
			<br>
			Desired Balance
			<input type="number" name="balance">
			<br>
			<button type="submit">register</button> or <a href="../index.php">login</a>
		</form>
	</div>

</body>
</html>