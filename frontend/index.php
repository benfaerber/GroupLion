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

		<!-- Jumbotron Header -->
		<header class="jumbotron my-4">
			<h1 class="display-6">Welcome, Test</h1>
			<p class="lead">GroupLion is an academic social networking site that will allow you create and
join study groups with like minded students. It's basically tinder for studying!
GroupLion is exclusive to students and courses at the University of Utah and you will
recieve recommendations based on your class schedule. You can also create and manage your own
groups and schedule events to meet up with other students with similar schedules. GroupLion
is a good tool to meet other dedicated students in your field and build a strong network for
learning on campus.</p>
		</header>
		<?php include "include/ext/messages.php"; ?>		
		
		<!-- Group -->
		<div class="row text-left">

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100">
					<div class="card-header text-left">
						John  Smith's Group for CS 1400
						<img src="https://img.icons8.com/color/1600/person-male.png" width="32px" class="rounded float-right"> 
					</div>
					<div class="card-body">
						<h4 class="card-title"><i class="fas fa-laptop-code"></i> PHP Programmers</h4>
						<p class="card-text">This is information about the group. This is information about the group. This is information about the group.</p>
					</div>
					<div class="card-footer text-right">
						<a href="group.php" class="btn btn-primary">View Group <i class="fas fa-unlock fa-left-3"></i></a>
						<a href="#" class="btn btn-success">Joined <i class="fas fa-check fa-left-3"></i> </a>
						<!-- request envelope -->
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100">
					<div class="card-header text-left">
						Jane Doe's Group for Chemistry
						<img src="https://maxcdn.icons8.com/Share/icon/Users/person_female1600.png" width="32x" class="rounded float-right"> 
					</div>
					<div class="card-body">
						<h4 class="card-title"><i class="fas fa-flask"></i> Chemistry Test Prep</h4>
						<p class="card-text">This is information about the group. This is information about the group. This is information about the group.</p>
					</div>
					<div class="card-footer text-right">
						<a href="#" class="btn btn-primary">Request Membership <i class="fas fa-envelope fa-left-3"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100">
					<div class="card-header text-left">
						Ronald Regan's Group for Math
						<img src="https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/1_avatar-512.png" width="32x" class="rounded float-right"> 
					</div>
					<div class="card-body">
						<h4 class="card-title"><i class="fas fa-calculator"></i> Calculus Practice</h4>
						<p class="card-text">This is information about the group. This is information about the group. This is information about the group.</p>
					</div>
					<div class="card-footer text-right">
						<a href="#" class="btn btn-primary">Join Group <i class="fas fa-door-open fa-left-3"></i></a>
					</div>
				</div>
			</div>


		</div>
		<!-- /.row -->

	</div>
	<!-- /.container -->

	<?php footer(true); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
</body>

</html>
