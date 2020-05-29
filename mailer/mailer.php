<?php

// This should work fine for registration emails but I'm worried about mass group messaging...
// Maybe create a "to send" DB with a Cron job spacing out the sending?
// Maybe use 3rd party mailer?
// I'm stumped man
// March 1rst

class Email
{
	public $templateFile;

	public $template;
	public $templateSubject;
	public $fromAddress;
	public $headers;

	public $subject;
	public $message;

	function __construct($templateFile)
	{
		$this->templateFile = $templateFile;

		$this->loadTemplate();
		$this->setHeaders();
	}

	function loadTemplate()
	{
		global $ROOT;
		
		$this->template = file_get_contents($ROOT . "mailer/" . $this->templateFile);
		$lines = explode("\n", $this->template);

		$this->fromAddress = trim(explode(":", $lines[0])[1]);
		$this->templateSubject = trim(explode(":", $lines[1])[1]);

		$cutPoint = strpos($this->template, $this->templateSubject) + strlen($this->templateSubject) + 1;
		$this->template = trim(substr($this->template, $cutPoint));
	}

	function setHeaders()
	{
		$this->headers = "MIME-Version: 1.0" . "\r\n";
		$this->headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$this->headers .= 'From: <' . $this->fromAddress . '>' . "\r\n";
	}

	function buildMessage($replacementMap)
	{
		$this->message = $this->template;
		$this->subject = $this->templateSubject;
		foreach ($replacementMap as $variable => $value)
		{
			$variable = "{{" . $variable . "}}";
			$this->message = str_replace($variable, $value, $this->message);
			$this->subject = str_replace($variable, $value, $this->subject);
		}
	}

	function send($sender)
	{
		$this->buildMessage($sender->replacementMap);
		mail($sender->toAddress, $this->subject, $this->message, $this->headers);
	}

	function output($sender)
	{
		$this->buildMessage($sender->replacementMap);
		echo "To: " . $sender->toAddress . "<br>";
		echo "From: " . $this->fromAddress . "<br>";
		echo "Subject: " . $this->subject;
		echo "<hr>";
		echo $this->message;
		echo "<hr>";
	}
}

class Sender
{
	public $toAddress;
	public $replacementMap;

	function __construct($toAddress, $replacementMap)
	{
		$this->toAddress = $toAddress;
		$this->replacementMap = $replacementMap;
	}
}

include "emails.php";
?>
