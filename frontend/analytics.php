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
			<h1 class="display-6">Analytics</h1>
			<p class="lead">I wonder what the users are up to?</p>
		</header>
		<?php include "include/ext/messages.php"; ?>		
		
		<h4>Line Count</h4>
		<ul class="list-group">
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    file.php
		    <span class="badge badge-primary badge-pill">100</span>
		  </li>
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    other.php
		    <span class="badge badge-primary badge-pill">2</span>
		  </li>
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    final.php
		    <span class="badge badge-primary badge-pill">1</span>
		  </li>
		</ul>
		<br>
		<h4>Database Count</h4>
		<ul class="list-group">
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    Users
		    <span class="badge badge-primary badge-pill">100</span>
		  </li>
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    Groups
		    <span class="badge badge-primary badge-pill">2</span>
		  </li>
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    Courses
		    <span class="badge badge-primary badge-pill">1</span>
		  </li>
		   <li class="list-group-item d-flex justify-content-between align-items-center">
		    Subjects
		    <span class="badge badge-primary badge-pill">1</span>
		  </li>
		</ul>


	</div>
	<!-- /.container -->

	<?php footer(true); ?>

	<?php include "include/view/baseJs.php"; ?>
</body>

</html>
