<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>My Schedule - GroupLion</title>

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
			<h1 class="display-6">My Schedule</h1>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
		</header>
		<?php include "include/ext/messages.php"; ?>

			<!-- Group -->
			<div class="row text-left">

				<div class="col-lg-2">
					<div class="form-group has-feedback">
						<!-- Subject search -->
						<label class="col-form-label" for="inputDefault">Subject Search</label>
						<input type="text" class="form-control" placeholder="Subject..." data-toggle="dropdown">
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
					</div>
				</div>

				<div class="col-lg-10">
					<div class="form-group has-feedback">
						<!-- Course Search -->
						<label class="col-form-label" for="inputDefault">Course Search</label>
						<input type="text" class="form-control" placeholder="Course..." data-toggle="dropdown">
						<div class="dropdown-menu col-lg-10">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
					</div>
				</div>

			</div>
			<!-- /.row -->

			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Catalog ID</th>
						<th scope="col">Subject</th>
						<th scope="col">Course</th>
						<th scope="col">Instructors</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i = 0; $i < 4; $i++) { ?>
						<tr class="<?= ($i % 2 == 0 ? "table-secondary" : "table-light"); ?>">
							<th scope="row">1400</th>
							<td>CS</td>
							<td>Object Oriented Programming</td>
							<td>
								<select class="form-control" id="exampleSelect1">
									<option>Teacher 1</option>
									<option>Teacher 2</option>
									<option>Teacher 3</option>
								</select>
							</td>
							<td><button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></td>
						</tr>
					<?php } ?>
				</tbody>
			</table> 
			<form class="form-group">
				<button type="button" class="btn btn-primary">Save <i class="fas fa-save fa-left-3"></i></button>
				<small id="emailHelp" class="form-text text-success">Done <i class="fas fa-check fa-left-3"></i></small>
			</form>

	</div>
	<!-- /.container -->

	<?php footer(true); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
</body>

</html>
