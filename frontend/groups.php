<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Groups - GroupLion</title>

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
			<h1 class="display-6">Groups</h1>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
		</header>
		<?php include "include/ext/messages.php"; ?>

		<div id="accordion">

			<div class="card">
				<div class="card-header" data-toggle="collapse" href="#collapseOne">
						Join with Invite Code
				</div>
				<div id="collapseOne" class="collapse show" data-parent="#accordion">
					<div class="card-body">
						<label>Enter you invite code to join a private group.</label>
						<div class="form-group row">
								<input class="form-control form-control-lg col-lg-2 col-md-2 col-sm-3" type="text" placeholder="ABCDE" maxlength="5" oninput="this.value = this.value.toUpperCase()" id="inputLarge">
								<button class="btn btn-primary col-lg-1 col-md-2 col-sm-2">Join</button>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" data-toggle="collapse" href="#collapseTwo">
					Create Group
				</div>
				<div id="collapseTwo" class="collapse" data-parent="#accordion">
					<div class="card-body">
						<?php include "include/view/createGroup.php"; ?>
					</div>
				</div>
			</div>

		</div>

		<br>
		<li class="list-group-item"><h4><i class="fas fa-user fa-left-3"></i> My Groups</h4></li>
		<div class="row text-left">
			<?php for ($i = 0; $i < 4; $i++) { ?>
				<?php include "include/view/group.php"; ?>
			<?php } ?>
		</div>

		<li class="list-group-item"><h4><i class="fas fa-user-friends fa-left-3"></i> Recommended Groups</h4></li>
		<div class="row text-left">
			<?php for ($i = 0; $i < 3; $i++) { ?>
				<?php include "include/view/group.php"; ?>
			<?php } ?>
		</div>

		<li class="list-group-item"><h4><i class="fas fa-users fa-left-3"></i> Available Groups</h4></li>
		<div class="row text-left">
			<?php for ($i = 0; $i < 8; $i++) { ?>
				<?php include "include/view/group.php"; ?>
			<?php } ?>
		</div>

		<!-- /.row -->
	</div>
	<!-- /.container -->

	<?php footer(false); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
	<script src="js/validateGroup.js"></script>
</body>

</html>
