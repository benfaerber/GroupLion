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
		  <h3 class="card-header align-middle"><img src="https://www.placehold.it/64x64" width="45px" class="rounded"> $(John Smith)</h3>
		  <ul class="list-group list-group-flush">
		  	<li class="list-group-item">
		  		<button class="btn btn-primary">Request Contact <i class="fas fa-envelope fa-left-3"></i></button>
					<button class="btn btn-primary">Request Pending <i class="fas fa-paper-plane fa-left-3"></i></button>
		  	</li>
		    <li class="list-group-item">Name: John Smith</li>
		    <li class="list-group-item">Email: jsmith45@email.com</li>
		  </ul>
		</div>

		<?php include "include/ext/messages.php"; ?>
	
		<div class="card mb-3">
		  <h3 class="card-header align-middle" id="incomingRequests"><i class="fas fa-envelope fa-right-3" id="reqIcon"></i> Incoming Requests</h3>
		  <ul class="list-group list-group-flush">
		  	<li class="list-group-item">
		  		Contact request from <a href="profile.php">John Smith (u1234567@utah.edu)</a>
		  		<button class="btn btn-danger float-right">Deny <i class="fas fa-times fa-left-3"></i></button><span> </span>
					<button class="btn btn-primary float-right">Accept <i class="fas fa-check fa-left-3"></i></button>
		  	</li>
		  </ul>
		</div>

	</div>
	<!-- /.container -->

	<?php footer(false); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
	<script src="js/validateLogin.js"></script>
	<script>
		$("#incomingRequests").hover(function() {
			$("#reqIcon").removeClass("fa-envelope");
			$("#reqIcon").addClass("fa-envelope-open-text");
		},
		function() {
			$("#reqIcon").removeClass("fa-envelope-open-text");
			$("#reqIcon").addClass("fa-envelope");
		});
	</script>
</body>

</html>
