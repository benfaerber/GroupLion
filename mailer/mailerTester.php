<?php
include "mailer.php";

function testMailer()
{
	$replaceMap = [
		"firstname" => "Ben",
		"link" => "http://localhost/verifyEmail.php?v=1203240"
	];
	$testSender = new Sender("example@test.com", $replaceMap);
	$testEmail = new Email("registerEmail.html");
	$testEmail->output($testSender);
	$testEmail->send($testSender);
}

testMailer();

?>