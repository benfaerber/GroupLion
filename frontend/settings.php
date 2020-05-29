<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>GroupLion</title>

	<link href="vendor/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
</head>

<body>

	<?php include "header.php"; ?>

	<!-- Page Content -->
	<div class="container">
			<br><br><br>

			<div class="card mb-3">
		  <h3 class="card-header">Your Info</h3>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item">Name: John Smith</li>
		    <li class="list-group-item">Email: jsmith45@email.com</li>
		  </ul>
		</div>

		  <div class="card mb-3">
		  <h3 class="card-header">Change Password</h3>
		  <div class="card-body">

		    <div class="form-group has-danger">
		      <label for="oldPassword">Old Password</label>
		      <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Password123$">
		    </div>

		    <div class="form-group has-danger">
		      <label for="newPassword">New Password</label>
		      <input type="password" class="form-control" name="newPassword" id="password" placeholder="Wordpass123$" onchange="validatePassword()" oninput="editValidatePassword()">
		      <div class="invalid-feedback">This doesn't look like a valid password</div>
		    </div>

		    <div class="form-group">
		      <label for="oldPassword">Repeat New Password</label>
		      <input type="password" class="form-control" name="repeatNewPassword" id="repeatPassword" placeholder="Wordpass123$" onchange="validateRepeatPassword()" oninput="editValidateRepeatPassword()">
		     	<div class="invalid-feedback">Sorry! These passwords don't match</div>
		    </div>

		    <input type="submit" name="changePasswordSubmit" id="register" value="Change Password" class="btn btn-primary">
		  </div>
			</div>
	

			<div class="card mb-3">
		  <h3 class="card-header">Change Profile Image</h3>
		  <div class="card-body">
		  	<div>
		  		 <label for="pfp">Current:</label><br>
		  		<img src="https://www.placehold.it/64x64" width="64px" class="rounded">
		  	</div>
		  	<br>
	  	 <div class="form-group">
	      <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
	      <small id="fileHelp" class="form-text text-muted">Please upload a square png, jpg, or gif file.</small>
	   	 </div>
	   	 <button class="btn btn-primary">Upload Image</button>
	   	 <button class="btn btn-danger">Delete Image</button>
		 </div>
		</div>





	</div>
	<!-- /.container -->

<?php footer(false); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
	<script src="js/validateRegister.js"></script>

</body>

</html>
