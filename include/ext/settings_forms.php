<?php

$passwordChangeResponse = "";

if (isset($_POST["changePasswordSubmit"]))
{
	$passwordChangeResponse = validatePasswordChange();
	if ($passwordChangeResponse == "OK")
		$passwordChangeResponse = "Your password was changed!";
}

$uploadPfpResponse = "";
if (isset($_POST["uploadPfpSubmit"]))
{
	$uploadPfpResponse = uploadPfp($user);
	if ($uploadPfpResponse == "UPLOAD OK")
		$uploadPfpResponse = "Your profile picture was uploaded successfully!";
	else if ($uploadPfpResponse == "UPDATE OK")
		$uploadPfpResponse = "Your profile picture was updated successfully";
}

?>