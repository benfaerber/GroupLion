<?php
function setActive($page)
{
	echo (strstr($_SERVER['REQUEST_URI'], $page) !== false ? "active" : "");
}
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top"> <!--navbar-dark bg-dark-->
	<div class="container">
		<a class="navbar-brand" href="index.php"><span class="h4"><img src="img/logo.png" width="45px"> GroupLion</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item <?php setActive("index.php"); ?>" >
					<a class="nav-link" href="index.php">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item <?php setActive("schedule.php"); ?>">
					<a class="nav-link" href="schedule.php">My Schedule
					</a>
				</li>
				<li class="nav-item <?php setActive("groups.php"); ?>">
					<a class="nav-link" href="groups.php">Groups</a>
				</li>
				<li class="nav-item dropdown <?php setActive("profile.php"); setActive("settngs.php");?>">

			    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">Test User</a>
			    <div class="dropdown-menu" x-placement="bottom-start">
			      <a class="dropdown-item" href="profile.php">Profile <i class="fas fa-user-circle float-right"></i></a>
			      <a class="dropdown-item" href="settings.php" id="settings">Settings <i class="fas fa-cog float-right" id="settingsIcon"></i></a>
			      <div class="dropdown-divider"></div>
			      <a class="dropdown-item" href="signout.php">Sign Out <i class="fas fa-sign-out-alt float-right"></i></a>
			    </div>

			  </li>
			</ul>
			<a href="profile.php"><img src="https://www.placehold.it/64x64" class="rounded"></a>
		</div>
	</div>
</nav>

<?php function footer($pushToBottom) { ?>
	<?php $pushToBottom = false; ?>
<!-- Footer -->
<footer class="py-5 bg-secondary <?= ($pushToBottom ? 'fixed-bottom' : ''); ?>">
	<div class="container">
		<p class="m-0 text-center text-black">Copyright &copy; GroupLion <?= date("Y"); ?></p>
		<div class="custom-control custom-switch float-right">
      <input type="checkbox" class="custom-control-input" id="themeToggle" checked="" onchange="toggleTheme()">
     	<label class="custom-control-label" for="themeToggle" id="themeName">Dark</label>
    </div>
	</div>
	<!-- /.container -->
</footer>

<?php } ?>