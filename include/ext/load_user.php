<?php

// Create the user
$loggedIn = false;
$user = null;

if (isset($_SESSION["user_id"]))
{
	$loggedIn = true;
	$user = getUser($_SESSION["user_id"]);
}

if ($loggedIn)
{
	if (!$user->isVerified() && strpos($_SERVER["SCRIPT_FILENAME"], "verifyEmail") === false)
		header("Location: verifyEmail.php");
}

?>