<html>
	<head>
		<title>Group</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include $inc . "db/db_schedule.php";
include $inc . "db/db_group.php";
include $inc . "db/db_event.php";
include $inc . "view/group_admin.php";
include $inc . "view/group_member.php";
include $inc . "view/event_display.php";
include $inc . "security/group_security.php";
include $inc . "ext/edit_group.php";
include $inc . "ext/group_forms.php";
include "header.php";

groupSecurityPrecheck();

$group = getGroup($_GET["id"], true);
$joinPrivateGroupResponse = "";
$createEventResponse = "";

groupSecurityPostcheck();

$isEditing = false;
if ($loggedIn && $group->isAdmin($user->userId))
{
	if (isset($_GET["edit"]))
		$isEditing = true;
}

$events = getEvents($group->groupId);

$memberCount = $group->getMemberCount();
$builtMemberString = $memberCount . " Member" . ($memberCount == 1 ? "" : "s");
?>

<h3>
	<?php if (!$isEditing): ?>
		<?= $group->title; ?>
	<?php else: ?>
		<input type="text" id="groupTitle" value="<?= $group->title; ?>" placeholder="Group Title">
	<?php endif ?>
	<small>
		<span class="privacyDisplay">
			<?php if (!$isEditing): ?>
				(<?= $group->getPrivacyTitle(); ?>)
			<?php else: ?>
				<input type="hidden" id="groupPrivacyValue" value="<?= $group->privacy; ?>">
				<select id="groupPrivacy">
					<option value="1">Public</option>
					<option value="2">Private and Visible</option>
					<option value="3">Private and Invisible</option>
				</select>
			<?php endif ?>
		</span>
	</small>
</h3>
<p>
	<span class="groupCourse">
		<?php if (!$isEditing): ?>
				Study Group for <?= $group->forCourse->courseTitle; ?>		
			<?php else: ?>
				<input type="hidden" id="courseSelectValue" value="<?= $group->forCourse->courseId; ?>">
				Study Group for <select id="courseSelect"></select>
		<?php endif ?>
	</span><br>
	<p>
		<?php if (!$isEditing): ?>
			<p><?= $group->description; ?></p>
		<?php else: ?>
			<textarea placeholder="Description" id="groupDescription"><?= $group->description; ?></textarea>	
		<?php endif ?>
	</p>
	<span class="groupAdmin">Lead by <?= $group->admin->name; ?></span><br>
	<img src="<?= $group->admin->pfp; ?>" width="64px" class="groupAdminPfp"><br>
	<span class="groupMemberCount"><?php
		echo $builtMemberString;
		?></span><br>
	<span class="groupMembers"><?= $group->getMemberNames(); ?></span><br>
	<?php if ($isEditing): ?>
		<button onclick="saveEdit()">Save Edit</button>
		<a href="group.php?id=<?= $group->groupId; ?>">Cancel Edit</a>
	<?php endif ?>
</p>

<h3>Group Events</h3>
<?php 
	foreach ($events as &$eve)
		displayEvent($eve);
?>

<?php
// Managment settings
if ($loggedIn)
{
	if ($group->isAdmin($user->userId))
	{
		if (!$isEditing)
			displayAdminPanel($group, $createEventResponse);
	}
	else if ($group->isMember($user->userId))
	{
		displayMemberPanel($group);
	}
	else
	{
		if ($group->privacy == $group->PRIVACY_PUBLIC)
			displayNonMemberPublic($group);
		else
			displayNonMemberPrivate($group, $joinPrivateGroupResponse);
	}
}
else if (!$isEditing)
{
	displayNotLoggedIn($group);
}

?>



	<script>document.getElementsByTagName("title")[0].innerHTML = "Group - <?= $group->title; ?>";</script>
	<script src="vendor/jquery.min.js"></script>

	<?php if ($isEditing): ?>
			<!-- JS only needed in edit mode -->
			<?= scheduleAsHtml($user->userId); ?>
			<script src="js/schedule.js"></script>
			<script src="js/editGroup.js"></script>
			<script type="text/javascript">addAllCourses(true);</script>
			<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" id="editForm">
				<input type="hidden" id="editTitle" name="editTitle" value="">
				<input type="hidden" id="editPrivacy" name="editPrivacy" value="">
				<input type="hidden" id="editCourse" name="editCourse" value="">
				<input type="hidden" id="editDescription" name="editDescription" value="">
				<input type="hidden" id="eventCount" name="eventCount" value="">
			</form>
	<?php endif ?>


	<?php if (!$isEditing && $loggedIn && $group->isAdmin($user->userId)) { ?>
		<script>
		function confirmDelete()
		{
			var deleteButton = document.getElementById("deleteGroupSubmit");
			var promptInput = prompt("Are you sure you would like to delete this group?\nEnter the following phrase if are sure: Abracadabra");

			if (promptInput.toLowerCase() == "abracadabra")
				deleteButton.click();
		}
		</script>
	<?php } ?>
	</body>
</html>