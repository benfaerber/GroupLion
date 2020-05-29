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
		<br><br><br><br>
		<?php include "include/ext/messages.php"; ?>

		<div class="card mb-3">
		  <h3 class="card-header">Register</h3>
		  <div class="card-body">

		    <div class="form-group has-danger">
		      <label for="exampleInputEmail1">University of Utah Email</label>
		      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="u1234567@utah.edu" onchange="validateEmail()" oninput="editValidateEmail()">
		      <div class="invalid-feedback">This is an invalid email. Make sure you are using a utah.edu email.</div>
		      <small id="emailHelp" class="form-text text-muted">We will never spam you or share your email with anyone.</small>
    		</div>

		    <div class="form-group has-danger">
		      <label for="exampleInputPassword1">Password</label>
		      <input type="password" class="form-control" id="password" name="password" placeholder="Password$123" onchange="validatePassword()" oninput="editValidatePassword()">
		      <div class="invalid-feedback" id="password-error">This password is invalid</div>

		      	<small id="passwordStrength" class="form-text text-muted">Password Strength: <span id="strengthValue">None</span></small>
			     <div class="progress">
					  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="strengthBar" role="progressbar"></div>
					</div>

					<small id="passwordHelp" class="form-text text-muted">We encrypt all passwords to keep your data safe!</small>
		    </div>

		    <div class="form-group has-danger">
		      <label for="exampleInputPassword1">Repeat Password</label>
		      <input type="password" class="form-control" id="repeatPassword" name="repeatPassword" placeholder="Password$123" onchange="validateRepeatPassword()" oninput="editValidateRepeatPassword()">
		      <div class="invalid-feedback">Your passwords do not match.</div>
		    </div>

		    <div class="form-group has-danger">
		      <label for="exampleInputPassword1">Real Name</label>
		      <input type="text" class="form-control" id="realName" name="realName" placeholder="John Doe" onchange="validateName()" oninput="editValidateName()">
		      <div class="invalid-feedback">There is a problem with your name.</div>
		     	<small id="passwordHelp" class="form-text text-muted">We need your name so other students can find you.</small>
		    </div>

		    <div class="form-group">
		    	<button class="btn btn-primary" id="register" name="registerSubmit">Register</button>
		    </div>

		  </div>
		  <div class="card-footer text-muted">
		    Already have an account? <a href="login.php">Login Here!</a>
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
