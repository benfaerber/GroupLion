<form>
	<fieldset>
		<div class="form-group has-danger">
			<label for="groupName">Group Title</label>
			<input type="text" class="form-control" placeholder="My Group" id="groupTitle" name="groupTitle" onchange="validateTitle()" oninput="editValidateTitle()">
			<div class="invalid-feedback" id="titleError">This doesn't look right</div>
		</div>

		<div class="form-group">
			<label for="forCourse">For Course</label>
			<select class="form-control" id="groupCourse" name="groupCourse">
				<option>CS 1400</option>
				<option>Fun Classs</option>
				<option>Basket Weaving</option>
			</select>
		</div>

		<div class="form-group has-danger">
			<label for="exampleTextarea">Group Description</label>
			<textarea class="form-control" id="groupDescription" name="groupDescription" rows="3" placeholder="In my group we..." onchange="validateDescription()" oninput="editValidateDescription()"></textarea>
			<div class="invalid-feedback" id="descriptionError">This doesn't look right</div>
		</div>

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
		<button type="submit" class="btn btn-primary" id="createGroup">Create Group</button>
	</fieldset>
</form>