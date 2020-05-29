
<?php function displayCreateEvent() { ?>
<div class="card">
	<div class="card-header" data-toggle="collapse" href="#createEvent">
		<span class="h5">Create Event</span>
	</div>
	<div id="createEvent" class="collapse" data-parent="#accordion">
		<div class="card-body">
			<?php displayCreateEventForm(false); ?>
		</div>
	</div>
</div>
<?php } ?>

<?php function displayEditEvent($event, $i) { ?>
	<div class="card">
		<div class="card-body">
			<?php displayCreateEventForm(true); ?>
		</div>
	</div>
<?php } ?>

<?php function displayCreateEventForm($isEdit) { ?>

<form>
	<fieldset>
		<div class="form-group has-danger">
			<label for="exampleInputPassword1">Event Name</label>
			<input type="text" class="form-control" placeholder="My Event" id="groupTitle" onchange="validateTitle()" oninput="editValidateTitle()" value="<?= $isEdit ? 'Event Name' : ''; ?>">
			<div class="invalid-feedback" id="titleError">This doesn't look right</div>
		</div>

		<div class="form-group">
			<label for="eventDate">Event Date</label>
			<div class="row">
				<input type="text" class="datepicker form-control col-2" placeholder="mm/dd/yyyy" id="eventDate" name="eventDate" style="margin-left: 1em" value="<?= $isEdit ? '01/01/2020' : ''; ?>">
		 		<div class="input-group bootstrap-timepicker col-2">
          <input id="eventTime" name="eventTime" type="text" class="timepicker form-control input-small" placeholder="hh:mm am" value="<?= $isEdit ? '12:30 AM' : ''; ?>">
        </div>
			</div>
		</div>

		<div class="form-group has-danger">
			<label for="exampleTextarea">Group Description</label>
			<textarea class="form-control" id="groupDescription" rows="3" onchange="validateDescription()" oninput="editValidateDescription()" placeholder="In my group we..."><?= $isEdit ? 'This is where the description goes.' : ''; ?></textarea>
			<div class="invalid-feedback" id="descriptionError">This doesn't look right</div>
		</div>

		<?php if (!$isEdit): ?>
			<button class="btn btn-primary">Create Event</button>
		<?php else: ?>
			<button class="btn btn-primary">Save Edit <i class="fas fa-save fa-left-3"></i></button>
		<?php endif ?>
</form>


<?php } ?>