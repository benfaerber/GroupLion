<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Group - GroupLion</title>

	<link href="vendor/bootstrap.css" rel="stylesheet">
	<link href="vendor/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="vendor/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

</head>

<body>
	<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	?>
	<?php include "include/view/event.php"; ?>
	<?php include "include/view/createEvent.php"; ?>
	<?php include "header.php"; ?>
	<?php $isEditing = isset($_GET["edit"]); ?>

	<!-- Page Content -->
	<div class="container">
		<br><br>
		<header>
			<div class="card mb-3">
				<h3 class="card-header">

					<?php if ($isEditing): ?>
				    	<input type="text" class="form-control col-6" id="groupTitle" placeholder="Group Title" value="<?= 'title'; ?>">
					<?php else: ?>

						<i class="fas fa-users fa-right-2"></i>	$grouptitle

					<?php endif ?>

					<span class="float-right">
						Invite Code: 
						<span id="inviteCode">ABCDEF</span>
						<?php if ($isEditing): ?>
							<button type="button" class="btn btn-primary">Change Invite Code <i class="fas fa-exchange-alt fa-left-2"></i></button>
						<?php endif ?>
					</span>
				</h3>
				<div class="card-body">
					<a href="profile.php" class="profile-link">
						<img src="https://www.placehold.it/64x64" class="rounded">
						<h5 class="card-title">John Smith</h5>
					</a>

					<?php if (!$isEditing): ?>

						<h6 class="card-subtitle text-muted">Private <i class="fas fa-lock fa-left-6"></i></h6>

					<?php endif ?>
					
				</div>
				<div class="card-body">

						<?php if ($isEditing): ?>
							<fieldset class="form-group">
								<label>Privacy Settings</label>
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="groupPrivacy" id="groupPrivacy1" value="1" checked="">
										<i class="fas fa-globe-americas fa-right-3"></i> Public - Anyone can join your group without permission
									</label>
								</div>
								<div class="form-check">
								<label class="form-check-label">
										<input type="radio" class="form-check-input" name="groupPrivacy" id="groupPrivacy2" value="2">
										<i class="fas fa-lock fa-right-3"></i> Private and Visible  - Your group is visible and anyone can request to join
									</label>
								</div>
								<div class="form-check disabled">
								<label class="form-check-label">
										<input type="radio" class="form-check-input" name="groupPrivacy" id="groupPrivacy3" value="3">
										<i class="fas fa-eye-slash fa-right-3"></i> Private and Invisible - Your group is not visible and only users with an invite code can join
									</label>
								</div>
							</fieldset>

							<div class="form-group">
								<label for="forCourse">For Course</label>
								<select class="form-control" id="groupCourse" name="groupCourse">
									<option>CS 1400</option>
									<option>Fun Classs</option>
									<option>Basket Weaving</option>
								</select>
							</div>

							<textarea class="form-control" id="groupDescription" placeholder="Group Description"><?= 'this is the description'; ?></textarea><br>
							<button class="btn btn-primary">Save Edit <i class="fas fa-save fa-left-3"></i></button>
							<a href="?endEdit" class="btn btn-danger">Cancel Edit<i class="fas fa-times fa-left-2"></i></a>

						<?php else: ?>
							For Course: CS 1400 Object-oriented Programming
							<p class="card-text">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								<br><br>
								<button type="button" class="btn btn-primary">Leave Group <i class="fas fa-door-open fa-left-2"></i></button>
								<button type="button" class="btn btn-primary">Join Group <i class="fas fa-sign-in-alt fa-left-2"></i></button>
								<button type="button" class="btn btn-success">Joined <i class="fas fa-check fa-left-2"></i></button>
								<a href="?edit" class="btn btn-primary">Edit Group <i class="fas fa-edit fa-left-2"></i></a>
							</p>

						<?php endif ?>
						
				</div>
			</div>
		</header>
		<?php include "include/ext/messages.php"; ?>

		<li class="list-group-item"><h4><i class="fas fa-exclamation-circle fa-left-3"></i> Join Today</h4></li>
		<div class="card">
		  <div class="card-body">
		  	<p class="lead">
		  		Join this group today by logging in or registering.
		  	</p>
				<a href="#">Login</a> or <a href="#">Register</a>
		  </div>
		</div>

		<br>
		<li class="list-group-item"><h4><i class="fas fa-calendar fa-left-3"></i> Upcoming Events</h4></li>
		<div id="accordion">

			<?php
			for ($i=0; $i < 2; $i++)
			{
				if (!$isEditing)
					displayEvent(null, $i);
				else
					displayEditEvent(null, $i);
			} 

			if (!$isEditing)
				displayCreateEvent();
			?>

		</div>
		<br>
		<?php if ($isEditing): ?>
			<button class="btn btn-danger" id="deleteBtn">Delete Group <i class="fas fa-trash-alt fa-left-3"></i></button>
			<div class="col-6" id="confirmForm" style="display: none;">
				<span>Are you sure? Type "Abracadabra" to confirm delete.</span>
				<input type="email" class="form-control" id="confirmInput" placeholder="Abracadabra"><br>
    		<button class="btn btn-danger col-5" id="confirmBtn">Confirm Delete <i class="fas fa-exclamation-triangle fa-right-3"></i></button>
    		<button class="btn btn-primary col-5" id="cancelBtn">Cancel <i class="fas fa-undo fa-right-3"></i></button>
    	</div>


			<br><br>
		<?php endif ?>

	</div>
	<!-- /.container -->

	<?php footer(false); ?>

	<!-- Bootstrap core JavaScript -->
	<?php include "include/view/baseJs.php"; ?>
	<script src="vendor/bootstrap-datepicker.min.js"></script>
	<script src="vendor/bootstrap-timepicker.min.js"></script>
	<script>
		$(function() {
		    $('.datepicker').datepicker({
		      format: "mm/dd/yyyy",
		      todayHighlight: true,
		      autoclose: true,
		      startDate: '1d'
		  });

			$('.timepicker').timepicker({
		      minuteStep: 5,
		      showInputs: false,
		      disableFocus: true
		  });
		});
	</script>
	<?php if ($isEditing): ?>
		<script src="js/deleteConfirm.js"></script>
		<script src="js/validateGroup.js"></script>
	<?php endif ?>

</body>

</html>
