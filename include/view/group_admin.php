<?php function displayAdminPanel($group, $response) { ?>
	<h3>Admin Settings</h3>
	<p>
		Your invite code: <?= $group->inviteCode; ?>
		<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
			<input type="submit" value="Change Invite Code" name="changeInviteCodeSubmit">
		</form>
		<a href="<?= $_SERVER['REQUEST_URI']; ?>&edit=1"><button>Edit Group</button></a>
	</p>

	<h4>Create new event</h4>
	<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
		Event Title<br>
		<input type="input" name="eventTitle" placeholder="Title"><br>
		Event Description<br>
		<textarea name="eventDescription" placeholder="Description"></textarea><br>
		When will this event take place?<br>
		<input type="input" name="eventDate" placeholder="mm/dd/yyyy" size="8">
		<input type="input" name="eventTime" placeholder="03:30" size="2">
		<select name="timeSuffix">
			<option value="am">am</option>
			<option value="pm">pm</option>
		</select><br><br>
		<input type="submit" name="createEventSubmit" value="Create Event">
		<?= $response; ?>
	</form>

	<h4>Delete your group</h4>
	<button style="background: #f00; color: #fff" onclick="confirmDelete()">Delete Group</button>
	<form action="<?= $_SERVER['REQUEST_URI']; ?>" style="display: none" method="post">
		<input type="submit" name="deleteGroupSubmit" id="deleteGroupSubmit">
	</form>
<?php } ?>