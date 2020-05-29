<?php
if ($loggedIn) {
?>

		<p class="header">
			<img src="<?= $user->pfp; ?>" width="64px">
			<a href="index.php">Home</a> - 
			<a href="schedule.php">My Schedule</a> - 
			<a href="groups.php">Groups</a> - 
			<a href="settings.php">Settings</a> - 
			<a href="frontend/">Beta Frontend</a> - 
	<?php if ($user->isAdmin()) { ?>

			<a href="analytics.php">Analytics</a> - 

	<?php } ?>
			<a href="signout.php">Sign Out</a>
		</p>

<?php } else { ?>

	<p class="header">
		<a href="index.php">Home</a> - 
		<a href="groups.php">Groups</a> - 
		<a href="login.php">Login</a> - 
		<a href="register.php">Register</a>
	</p>

<?php } ?>

<?php include $inc . "ext/messages.php"; ?>
