<?php

if (!$loggedIn)
	header("Location: index.php?m=error");

// If the user is already verified, they can't come on this page
if ($user->isVerified())
	siteError("error");

if (isset($_GET["v"]))
{
	if ($_GET["v"] == $user->verificationCode)
	{
		verifyUser($user->userId);
		header("Location: index.php?m=email-verified");
	}
	else
	{
		siteError("invalid-verification");
	}
}

$response = "";
if (isset($_POST["resendEmail"]))
{
	if (!isset($_SESSION["resentVerify"]) || $_SESSION["resentVerify"] != "sent")
		sendVerifyEmail($user);
	$_SESSION["resentVerify"] = "sent";
	$response = "Email sent to " . $user->email . "...";
}


?>