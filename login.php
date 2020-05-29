<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include $inc . "security/login_user.php";
include "header.php";
?>

		<h3>Login</h3>
		<form action="login.php" method="post">
			<input type="text" name="email"placeholder="Email"><br>
			<input type="password" name="password" placeholder="Password"><br>
			<input type="submit" name="loginSubmit" value="Login">
		</form>
		<?php if ($response != "OK") echo $response; ?>
		<p>
			<a href="register.php">Register Here</a>
		</p>
	</body>
</html>