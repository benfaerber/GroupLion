<?php function displayEvent($event, $i) { ?>
		<div class="card">
			<div class="card-header" data-toggle="collapse" href="#collapse<?= $i; ?>">
				<span class="h5">My cool event <?= $i+1; ?></span>
				<span class="float-right">March 12th at 9:30AM <i class="fas fa-calendar-check fa-left-3" style="color: green"></i></span>
			</div>
			<div id="collapse<?= $i; ?>" class="collapse" data-parent="#accordion">
				<div class="card-body">
					<p>
					$eventdescription Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
					<div>
						<button type="button" class="btn btn-primary">RSVP</button>
					</div>
					<small>10 People have RSVPed so far.</small>
				</div>
			</div>
		</div>
<?php } ?>