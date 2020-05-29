<html>
	<head>
		<title>Settings</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php
include "include/base.php";
include $inc . "ext/upload_file.php";
include $inc . "ext/change_password.php";
include $inc . "ext/settings_forms.php";
include $inc . "security/signed_in_only.php";
include "header.php";
?>

		<h3>Settings</h3>
		<p>
			Name: <?= $user->name; ?><br>
			Email: <?= $user->email; ?><br>
			<?php
			if ($user->isAdmin())
				echo "Elevated Permissions: Admin";
			else if ($user->isMod())
				echo "Elevated Permissions: Moderator";
			?>
		</p>

		<h4>Change Password</h4>
		<form action="settings.php" method="post">
			<input type="password" name="oldPassword"placeholder="Old Password"><br>
			<input type="password" name="newPassword" placeholder="New Password"><br>
			<input type="password" name="repeatNewPassword" placeholder="Repeat New Password"><br>
			<input type="submit" name="changePasswordSubmit" value="Change Password">
		</form>
		<?php if ($passwordChangeResponse != "") echo $passwordChangeResponse; ?>

		<h4>Upload Profile Picture</h4>
		<p>
			Your profile picture:<br>
			<img src="<?= $user->pfp; ?>" width="64px">
		</p>

		<form action="settings.php" method="post" enctype="multipart/form-data">
			<input type="file" name="pfpUpload" id="pfpFileUpload"><br>
			<input type="submit" value="Upload" name="uploadPfpSubmit">
		</form>
		<?php if ($uploadPfpResponse != "") echo $uploadPfpResponse; ?>
	</body>
</html>