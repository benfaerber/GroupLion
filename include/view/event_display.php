
<?php function displayEvent($event) { ?>
	<?php global $loggedIn, $user, $isEditing, $group; ?>
<div class="event">
	<input type="hidden" value="<?= $event->eventId; ?>" class="eventId">
	<?php if (!$isEditing): ?>
		<strong><?= $event->title; ?></strong>
	<?php else: ?>
		<input type="text" class="eventTitle" placeholder="Event Title" value="<?= $event->title; ?>">
	<?php endif ?>
	<br>
	<?php if (!$isEditing): ?>
		<small><?= $event->getDateTime(); ?></small>
	<?php else: ?>
		<input type="text" class="eventTime" placeholder="mm/dd/yyyy hh:mmAm" value="<?= $event->getEncodableTime(); ?>"> Replace w jquery datepicker
	<?php endif ?>


	<p>	
		<?php if (!$isEditing): ?>
				<?= $event->description; ?>
		<?php else: ?>
				<textarea class="eventDescription" placeholder="Event Description"><?= $event->description; ?></textarea>
		<?php endif ?>
		<br>
		<small>
			<?= $event->getRsvpString(); ?>  have RSVPed to this event.
		</small>

		<?php if ($loggedIn): ?>
			<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
				<input type="hidden" class="eventId" value="<?= $event->eventId; ?>" name="eventId">
					<?php if (!$group->isAdmin($user->userId)): ?>
						<input type="submit" value="RSVP" name="rsvpSubmit">
					<?php else: ?>
						<input type="submit" value="Delete Event" name="deleteEventSubmit">
					<?php endif ?>
			</form>
			<?php if ($isEditing): ?>
				<button onclick="saveEdit()">Save Edit</button>
		<?php endif ?>
		<?php endif ?>
	</p>
</div>
<?php } ?>