<?php

function validatePasswordChange()
{
	$oldPassword = $_POST["oldPassword"];
	$newPassword = $_POST["newPassword"];
	$repeatNewPassword = $_POST["repeatNewPassword"];
	if (isset($oldPassword) && isset($newPassword) && isset($repeatNewPassword))
	{
		if ($newPassword != $repeatNewPassword)
			return "Make sure your new passwords match!";

		if (!verifyPassword($_SESSION["user_id"], $oldPassword))
			return "Your old password is incorrect";

		if ($oldPassword == $newPassword)
			return "Your new password cannot be your old password";

		changePassword($_SESSION["user_id"], $newPassword);
		return "OK";
	}
	else
	{
		return "Please fill out the form completley";
	}
}


?>