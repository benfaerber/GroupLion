<?php

// Join Public Group
if (isset($_POST["joinPublicGroupSubmit"]))
{
	addMember($group->groupId, $user->userId);
	header("Location: group.php?id=" . $group->groupId . "&m=joined-group");
}

// Join Private Group
if (isset($_POST["joinPrivateGroupSubmit"]))
{
	$inviteCode = $_POST["inviteCode"];
	if (isset($inviteCode))
	{
		$joinPrivateGroupResponse = validateInviteCode($inviteCode, $group->inviteCode);
		if ($joinPrivateGroupResponse == "OK")
		{
			addMember($group->groupId, $user->userId);
			header("Location: group.php?id=" . $group->groupId . "&m=joined-group");
		}
	}
}

// Delete group as admin
if (isset($_POST["deleteGroupSubmit"]))
{
	// Tee hee it doesn't actually delete just hides it UwU
	deleteGroup($group->groupId);
	header("Location: groups.php?m=group-deleted");
}

if (isset($_POST["changeInviteCodeSubmit"]))
{
	changeInviteCode($group->groupId);
	header("Location: group.php?id=" . $group->groupId);
}

//Leave group as member
if (isset($_POST["leaveGroupSubmit"]))
{
	removeMember($group->groupId, $user->userId);
	header("Location: group.php?id=" . $group->groupId . "&m=left-group");
}


function validateEventCreation()
{
	$date = $_POST["eventDate"];
	$time = $_POST["eventTime"];
	$suff = $_POST["timeSuffix"];
	$title = $_POST["eventTitle"];
	$descr = $_POST["eventDescription"];
	$vals = [$date, $time, $suff, $title, $descr];
	foreach ($vals as &$val)
	{
		if (!isset($val))
			return "Please set all of the required values";
	}

	//In future front end will do time validation

	// User text
	if (strlen($title) > 25)
		return "Your title is too long";

	if (strlen($descr) > 200)
		return "Your description is too long";

	if (strlen($title) < 5)
		return "Your description is too short";

	if (strlen($descr) < 10)
		return "Your description is too short";

	return "OK";
}

// Create event
if (isset($_POST["createEventSubmit"]))
{
	$createEventResponse = validateEventCreation();
	if ($createEventResponse == "OK")
	{
		$builtString = $_POST["eventDate"] . " " . $_POST["eventTime"] . " " .  $_POST["timeSuffix"];
		$time = stringToEpoch($builtString);
		createEvent($group->groupId, $_POST["eventTitle"], $_POST["eventDescription"], $time);
		header("Location: " . $_SERVER['REQUEST_URI'] . "&m=event-created");
	}
}

// Validating and creating groups
function valdiateCreateGroup($title, $forCourse, $privacy, $description)
{
	if ($title == "")
		return "Please enter a title";

	if (strlen($title) < 5)
		return "Your title is too short";
	if (strlen($title) > 30)
		return "Your title is too long";

	if (strlen($title) < 5)
		return "Your description is too short";
	if (strlen($title) > 200)
		return "Your description is too long";

	if ($privacy < 1 || $privacy > 3)
		return "This is an invalid privacy setting";

	return "OK";
}

$createGroupResponse = "";
if (isset($_POST["createGroupSubmit"]))
{
	$title = $_POST["groupTitle"];
	$forCourse = $_POST["courseSelect"];
	$privacy = $_POST["privacySelect"];
	$description = $_POST["groupDescription"];
	if (isset($title) && isset($forCourse) && isset($privacy))
	{
		$createGroupResponse = valdiateCreateGroup($title, $forCourse, $privacy, $description);
		if ($createGroupResponse == "OK")
		{
			$groupId = createGroup($title, $forCourse, $user->userId, $privacy, $description);
			header("Location: group.php?id=" . $groupId . "&m=group_created");
			// Go to the newly created group
		}
	}
	else
	{
		$createGroupResponse = "Please add required information";
	}
}

// Editing groups

if (isset($_POST["editTitle"]) && $_POST["editTitle"] != "")
{
	saveEditGroup();
}

?>