<?php

function addMember($groupId, $userId)
{
	global $db;
	$group = getGroup($groupId, false);
	$members = $group->membersId;
	if (in_array($userId, $members))
		return;

	if ($group->isAdmin($userId))
		return;

	array_push($members, $userId);
	$memberString = formMemberString($members);

	$sql = "UPDATE `groups` SET `group_members` = ? WHERE `group_id` = ?; ";
	$query = $db->prepare($sql);

	$query->bind_param("si", $memberString, $groupId);
	$query->execute();
}

function removeMember($groupId, $userId)
{
	global $db;
	$group = getGroup($groupId, false);
	$oldMembers = $group->membersId;

	if (!in_array($userId, $oldMembers))
		return;

	$newMembers = array();
	foreach ($oldMembers as &$member)
	{
		if ($member != $userId)
			array_push($newMembers, $member);
	}

	$memberString = formMemberString($newMembers);

	$sql = "UPDATE `groups` SET `group_members` = ? WHERE `group_id` = ?; ";
	$query = $db->prepare($sql);

	$query->bind_param("si", $memberString, $groupId);
	$query->execute();
}

function wipeMembers($groupId)
{
	global $db;
	$sql = "UPDATE `groups` SET `group_members` = '' WHERE `group_id` = ?; ";
	$query = $db->prepare($sql);

	$query->bind_param("i", $groupId);
	$query->execute();
}

function joinByInviteCode($inviteCode, $userId)
{
	global $db;
	$sql = "SELECT `group_id` FROM `groups` WHERE `group_invite_code` = ? ;";
	$query = $db->prepare($sql);

	$query->bind_param("s", $inviteCode);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	addMember($row["group_id"], $userId);
	return $row["group_id"];
}

function formMemberString($membersArray)
{
	$built = "";
	foreach ($membersArray as &$member)
		$built .= (string)$member . ";";
	return $built;
}

function createGroup($title, $forCourseId, $adminId, $privacy, $description)
{
	global $db;
	$sql = "INSERT INTO `groups`
	(`group_title`, `group_for_course`, `group_admin`, `group_privacy`, `group_invite_code`, `group_description`) VALUES
	(?, ?, ?, ?, ?, ?);";
	$query = $db->prepare($sql);

	$inviteCode = getInviteCode();
	$query->bind_param("siiiss", $title, $forCourseId, $adminId, $privacy, $inviteCode, $description);
	if (!$query->execute())
		echo "Error: " . $query->error;

	return getGroupIdByInfo($adminId, $inviteCode);
}

function editGroup($id, $title, $privacy, $course, $description)
{
	echo $id;
	global $db;
	$sql = "UPDATE `groups` SET
	`group_title` = ?,
	`group_for_course` = ?,
	`group_privacy` = ?,
	`group_description` = ?
	WHERE `group_id` = ?;";
	$query = $db->prepare($sql);
	$query->bind_param("siisi", $title, $course, $privacy, $description, $id);

	if (!$query->execute())
		echo "Error: " . $query->error;
}

function getGroupIdByInfo($adminId, $inviteCode)
{
	global $db;
	$sql = "SELECT `group_id` FROM `groups` WHERE
	`group_admin` = ? AND `group_invite_code` = ?; ";
	$query = $db->prepare($sql);

	$query->bind_param("is", $adminId, $inviteCode);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	return $row["group_id"];
}

function deleteGroup($groupId)
{
	wipeMembers($group->groupId);	
	updateGroupPrivacy($groupId, 0);
}

function updateGroupPrivacy($groupId, $privacy)
{
	global $db;
	$sql = "UPDATE `groups` SET `group_privacy` = ? WHERE `group_id` = ?; ";
	$query = $db->prepare($sql);
	$query->bind_param("ii", $privacy, $groupId);
	$query->execute();
}

// group_any is called by non logged in users (schedule doesn't matter)
$GROUP_ANY = 0;
// group not joined contains all the groups a user has not joined (that matches their schedule)
$GROUP_NOT_JOINED = 1;
// all groups the user has joined
$GROUP_JOINED = 2;
// all groups the user admins
$GROUP_ADMIN = 3;
function getGroups($option)
{
	global $db;
	global $GROUP_ANY, $GROUP_NOT_JOINED, $GROUP_JOINED, $GROUP_ADMIN;
	global $user, $loggedIn;

	if ($loggedIn)
	{
		$frontPaddedMember = (string)$user->userId . ";%";
		$backPaddedMember = "%;" . (string)$user->userId;
		$bothPaddedMember = "%;" . (string)$user->userId . ";%";
	}

	if ($option == $GROUP_ANY)
	{
		$sql = "SELECT * FROM `groups`; ";
		$query = $db->prepare($sql);
	}
	else if ($option == $GROUP_NOT_JOINED)
	{
		$sql = "SELECT * FROM `groups`
		WHERE `group_members` NOT LIKE ? AND
		`group_members` NOT LIKE ? AND
		`group_members` NOT LIKE ? AND
		`group_admin` != ?";
		$query = $db->prepare($sql);
		$query->bind_param("sssi", $frontPaddedMember, $backPaddedMember, $bothPaddedMember, $user->userId);
	}
	else if ($option == $GROUP_JOINED)
	{
		$sql = "SELECT * FROM `groups` WHERE
		(`group_members` LIKE ? OR `group_members` LIKE ? OR `group_members` LIKE ?) AND
		`group_admin` != ?; ";
		$query = $db->prepare($sql);
		$query->bind_param("sssi", $frontPaddedMember, $backPaddedMember, $bothPaddedMember, $user->userId);
	}
	else if ($option == $GROUP_ADMIN)
	{
		$sql = "SELECT * FROM `groups` WHERE `group_admin` = ?; ";
		$query = $db->prepare($sql);
		$query->bind_param("i", $user->userId);
	}	

	$query->execute();
	$queryResult = $query->get_result();
	$groups = array();
	while ($r = $queryResult->fetch_assoc())
	{
		$group = new Group($r["group_id"], $r["group_title"], $r["group_for_course"], $r["group_admin"], $r["group_members"], $r["group_privacy"], $r["group_invite_code"], $r["group_description"]);
		array_push($groups, $group);
	}
	return $groups;
}

function groupExists($groupId)
{
	global $db;
	$sql = "SELECT * FROM `groups` WHERE `group_id` = ?;";
	$query = $db->prepare($sql);
	$query->bind_param("i", $groupId);
	$query->execute();
	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	return isset($row["group_id"]);
}

function getGroup($groupId, $loadMembers)
{
	global $db;
	$sql = "SELECT * FROM `groups` WHERE `group_id` = ?;";
	$query = $db->prepare($sql);

	$query->bind_param("i", $groupId);
	$query->execute();

	$queryResult = $query->get_result();
	$r = $queryResult->fetch_assoc();
	$group = new Group($r["group_id"], $r["group_title"], $r["group_for_course"], $r["group_admin"], $r["group_members"], $r["group_privacy"], $r["group_invite_code"], $r["group_description"]);
	if ($loadMembers)
		$group->getMembers();
	return $group;
}

function changeInviteCode($groupId)
{
	global $db;
	$sql = "UPDATE `groups` SET `group_invite_code` = ? WHERE `group_id` = ?;";
	$query = $db->prepare($sql);

	$inviteCode = getInviteCode();
	$query->bind_param("si", $inviteCode, $groupId);
	$query->execute();
}

function getInviteCode() {
	$length = 5;
	$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$randomString = "";
	for ($i = 0; $i < $length; $i++)
		$randomString .= $characters[rand(0, strlen($characters) - 1)];

	// Don't give out an already existing invite code
	if (inviteCodeExists($randomString))
		return getInviteCode();

	return $randomString;
}

function inviteCodeExists($inviteCode)
{
	global $db;
	$sql = "SELECT `group_id` FROM `groups` WHERE `group_invite_code` = ? ;";
	$query = $db->prepare($sql);

	$inviteCode = strtoupper($inviteCode);
	$query->bind_param("s", $inviteCode);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	return isset($row["group_id"]);
}

function validateInviteCode($userInviteCode, $realInviteCode)
{
	$userInviteCode = strtoupper($userInviteCode);
	if (strlen($userInviteCode) != 5)
		return "This is not a valid invite code";

	if ($userInviteCode != $realInviteCode)
		return "This is not a valid invite code";

	return "OK";
}

?>