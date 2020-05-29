<html>
	<head>
		<title>Create Group</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include $inc . "db/db_group.php";
include $inc . "db/db_schedule.php";
include $inc . "ext/group_forms.php";
include $inc . "security/signed_in_only.php";
include "header.php";
?>

		<h3>Create a Group</h3>
		<form action="createGroup.php" method="post">
			<h4>Group Title</h4>
			<input type="text" name="groupTitle" placeholder="My Study Group">
			<h4>Group Description</h4>
			<textarea name="groupDescription"></textarea>
			<h4>Group Course</h4>
			<input type="hidden" value="" id="courseCount" name="courseCount">
			<select id="courseSelect" name="courseSelect"></select>
			<p>Don't see your course? Add it to <a href="schedule.php">your schedule</a>.</p>

			<h4>Privacy Settings</h4>
			<span>Public - Anyone can join this group</span><br>
			<span>Private and Visible - Anyone can see this group but need an invite code to join</span><br>
			<span>Private and Invisible - No one can see this group and can only join by entering an invite code</span><br>
			<select name="privacySelect">
				<option value="1">Public</option>
				<option value="2">Private and Visible</option>
				<option value="3">Private and Invisible</option>
			</select>
			<br><br>

			<input type="submit" name="createGroupSubmit" value="Create Group">
		</form>
		<?= $createGroupResponse; ?>

		<?php scheduleAsHtml($user->userId); ?>
		<script src="vendor/jquery.min.js"></script>
		<script src="js/schedule.js"></script>
		<script>
				addAllCourses(true);
		</script>
	</body>
</html>