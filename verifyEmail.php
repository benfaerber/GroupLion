<html>
	<head>
		<title>Verify Email</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include "mailer/mailer.php";
include "header.php";
include $inc . "security/verify_email.php";
?>

		<h3>Verify Email</h3>
		<p>We sent and email to <?= $user->email; ?>. Please check your email and click the verification link.</p>
		<form action="verifyEmail.php" method="post">
			<input type="submit" name="resendEmail" value="Resend Email">
		</form>
		<span><?= $response; ?></span>
	</body>
</html>