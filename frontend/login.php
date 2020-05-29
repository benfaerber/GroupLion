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
		<div class="card mb-3">
		  <h3 class="card-header">Login</h3>
		  <div class="card-body">
		    <div class="form-group has-danger">
		      <label for="exampleInputEmail1">Email or UID</label>
		      <input type="email" class="form-control" id="username" name="email" aria-describedby="emailHelp" placeholder="U1234567" onchange="validateEmail()" oninput="editValidateEmail()">
		      <div class="invalid-feedback">This doesn't look like an email or UID</div>
    		</div>
		    <div class="form-group has-danger">
		      <label for="exampleInputPassword1">Password</label>
		      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		      <div class="invalid-feedback">That password was incorrect.</div>
		    </div>
		    <div class="form-group">
		    	<button class="btn btn-primary">Login</button>
		    </div>
		  </div>
		  <div class="card-footer text-muted">
		    Don't have an account? <a href="register.php">Register Here!</a>
		  </div>
		</div>


		<?php include "include/ext/messages.php"; ?>
		

	</div>
	<!-- /.container -->

	<?php footer(false); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
	<script src="js/validateLogin.js"></script>
</body>

</html>
