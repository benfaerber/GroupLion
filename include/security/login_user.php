<?php

$response = "";
if (isset($_POST["loginSubmit"]))
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	if (isset($email) && isset($password))
	{
		if ($_POST["email"] == "admin")
			$email .= "@site.com";
		
		// Allow short hand email
		if (!strpos($email, '@utah.edu') && !strpos($email, '@umail.utah.edu') && !strpos($email, '@site.com'))
			$email .= "@utah.edu";

		if (loginUser($email, $password))
		{
			header("Location: index.php");
		}
		else
		{
			$response = "Incorrect email or password";
		}
	}
}

?>