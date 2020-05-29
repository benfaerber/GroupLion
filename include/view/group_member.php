<?php function displayMemberPanel($group) { ?>
	<h3>Member Settings</h3>
	<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
		<input type="submit" value="Leave Group" name="leaveGroupSubmit">
	</form>
<?php } ?>

<?php function displayNonMemberPublic($group) { ?>
<h3>Join this group</h3>
<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
	<input type="submit" value="Join Group" name="joinPublicGroupSubmit">
</form>
<?php } ?>

<?php function displayNonMemberPrivate($group, $response) { ?>
	<h3>Join this group</h3>
	<p>This group is private, the admin needs to give an invite code to join</p>
	<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
		<span>Invite Code</span>:
		<input type="text" size="6" maxlength="6" placeholder="ABCDEF" name="inviteCode">
		<input type="submit" value="Join Group" name="joinPrivateGroupSubmit">
	</form>
	<?= $response; ?>
<?php } ?>

<?php function displayNotLoggedIn($group) { ?>
	<p><a href="login.php">Login</a> or <a href="register.php">register</a> to join this group!</p>
<?php } ?>