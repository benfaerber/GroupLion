<?php

function validateUser($name, $email, $password, $repeatPassword)
{
	if (strlen($name) > 30)
		return "Your name is too long";

	// Invalid university email
	if (!preg_match("/u[0-9]{7}@(umail\.)?utah\.edu/i", $email) || strlen($email) > 25)
		return "This is not a valid university email";

	if ($password != $repeatPassword)
		return "Please make sure your passwords match";

	if (strlen($password) > 55)
		return "Your password is too long";

	if (!isEmailRegistered($email))
		return "OK";
	else
		return "A user has already registered with this email";
}

$response = "";
if (isset($_POST["registerSubmit"]))
{
	$name = $_POST["realname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$repeatPassword = $_POST["repeatPassword"];
	if (isset($name) && isset($email) && isset($password) && isset($repeatPassword))
	{
		$response = validateUser($name, $email, $password, $repeatPassword);
		if ($response == "OK")
		{
			$userId = createUser($name, $email, $password);
			createSchedule($userId);
			sendVerifyEmail(getUser($userId));
			header("Location: verifyEmail.php");
		}
	}
}

?>