<?php

function sendVerifyEmail($user)
{
	$email = new Email("registerEmail.html");
	$map = [
		"firstname" => $user->firstName,
		"link" => "localhost/verifyEmail.php?v=" . $user->verificationCode
	];
	$sender = new Sender($user->email, $map);
	$email->send($sender);
}

?>