<?php

function displayGroup($group)
{
	global $user, $loggedIn;
	if ($group->isVisible())
	{
?>
	<br>
	<div class="group">
		<a href="group.php?id=<?= $group->groupId; ?>">
			<h4 class="groupTitle">
				<?php
				echo $group->title;
				if ($loggedIn)
				{
					if ($group->isAdmin($user->userId))
					{
					?>
						<small class="adminText">Admin</small>
					<?php
					}

					if ($group->isMember($user->userId))
					{
					?>
						<small class="memberText">Member</small>
					<?php
					}
				}?>
			</h4>
		</a>
		<p>
			<span class="groupCourse">Study Group for <?= $group->forCourse->courseTitle; ?></span><br>
			<span class="groupAdmin">Lead by <?= $group->admin->name; ?></span><br>
			<img src="<?= $group->admin->pfp; ?>" width="64px" class="groupAdminPfp"><br>
			<span class="groupMemberCount"><?php
				$memberCount = $group->getMemberCount();
				echo $memberCount . " Member" . ($memberCount == 1 ? "" : "s");
				?></span><br>
			<span class="groupPrivacy">This group is <?= $group->getPrivacyTitle(); ?></span>
		</p>
	</div>
	<br>
<?php
	}
}

?>