<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include $inc . "db/db_schedule.php";
include $inc . "security/register_user.php";
include "mailer/mailer.php";
include "header.php";
?>


		<h3>Register</h3>
		<form action="register.php" method="post">
			<input type="text" name="realname" placeholder="Real Name"><br>
			<input type="text" name="email"placeholder="Utah Email Address"><br>
			<input type="password" name="password" placeholder="Password"><br>
			<input type="password" name="repeatPassword" placeholder="Repeat Password"><br>
			<input type="submit" name="registerSubmit" value="Register">
		</form>
		<?php if ($response != "OK") echo $response; ?>
		<p>
			<a href="login.php">Login Here</a>
		</p>
	</body>
</html>