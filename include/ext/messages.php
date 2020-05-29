<?php

class Message
{
	public $code;
	public $title;
	public $description;
	public $type;

	function __construct($code, $title, $description, $type)
	{
		if ($type == "e")
			$this->type = "error";
		if ($type == "w")
			$this->type = "warning";
		if ($type == "i" || $type == "")
			$this->type = "info";

		$this->code = $code;
		$this->title = $title;
		$this->description = $description;
	}
}

function m($code, $title, $description, $type)
{
	return new Message($code, $title, $description, $type);
}

//
$messages = [
	m("not-logged-in", "You are not logged in",
		"You must be logged in to access this page", "e"),
	m("error", "An error occured",
		"Please try again later", "e"),
	m("permission-denied", "Permission Denied",
		"You do not have permission to view this", "w"),
	m("signed-out", "Signed Out",
		"You have been signed out", "i"),
	m("group-created", "Group Created",
		"Your group has been created", "i"),
	m("account-created", "Account Created",
		"Your account has been created", "i"),
	m("left-group", "Left Group",
		"You have left the group", "i"),
	m("joined-group", "Joined Group",
		"You have joined the group", "i"),
	m("invalid-verification", "Invalid Verification ID",
		"Something went wrong with your registration, please try again later.", "e"),
	m("email-verified", "Email Verified",
		"Your email has been verified!", "i"),
	m("group-deleted", "Group Deleted",
		"Your group was deleted!", "i"),
	m("group-was-deleted", "This group was deleted",
		"You cannot access this group because it has been deleted", "e"),
	m("event-created", "Event Created",
		"Your event was scheduled.", "i"),
	m("group-updated", "Group Updated",
		"Your group was updated.", "i"),
];

if (isset($_GET["m"]))
{
	$messageCode = $_GET["m"];
	$message = null;
	foreach ($messages as &$currentMessage)
	{
		if ($currentMessage->code == $messageCode)
			$message = $currentMessage;
	}

	if ($message != null)
	{
?>

	<div class="message <?= $message->type; ?>">
		<strong><?= $message->title; ?></strong>: <?= $message->description; ?>
	</div>

<?php
	}
}
?>