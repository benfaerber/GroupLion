<html>
	<head>
		<title>Groups</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include $inc . "db/db_schedule.php";
include $inc . "db/db_group.php";
include $inc . "view/group_display.php";
include "header.php";

$joinPrivateGroupResponse = "";
if ($loggedIn)
{
	if (isset($_POST["joinPrivateGroupSubmit"]))
	{
		if (inviteCodeExists($_POST["inviteCode"]))
		{
			$groupId = joinByInviteCode($_POST["inviteCode"], $user->userId);
			header("Location: group.php?id=" . $groupId . "&m=joined-group");
		}
		else
		{
			$joinPrivateGroupResponse = "This is not a valid invite code";
		}
	}

	$joinedGroups = getGroups($GROUP_JOINED);
	$adminGroups = getGroups($GROUP_ADMIN);
	$notJoinedGroups = getGroups($GROUP_NOT_JOINED);
?>
	<h3>Create a group</h3>
	Create your own group <a href="createGroup.php">here</a>.

	<h3>Join Private Group</h3>
	<form action="groups.php" method="post">
		<span>Invite Code</span>:
		<input type="text" size="6" maxlength="6" placeholder="ABCDEF" name="inviteCode">
		<input type="submit" value="Join Group" name="joinPrivateGroupSubmit">
	</form>
	<?= $joinPrivateGroupResponse; ?>

	<h3>My Groups</h3>

<?php
	// Show the groups a user leads first
	foreach ($adminGroups as &$currentGroup)
		displayGroup($currentGroup);

	// Show all the groups a user is a member of
	foreach ($joinedGroups as &$currentGroup)
		displayGroup($currentGroup);
?>

	<h3>Available Groups</h3>
<?php
	foreach ($notJoinedGroups as &$currentGroup)
		displayGroup($currentGroup);
// Show the groups availble
}
else
{
	// If user is not signed, show all groups
	$groups = getGroups($GROUP_ANY);
?>
	<h3>Groups</h3>
<?php
	foreach ($groups as &$currentGroup)
		displayGroup($currentGroup);
} ?>
	</body>
</html>