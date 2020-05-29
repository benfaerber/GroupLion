<?php
function saveEditGroup()
{
	global $group;
	$title = $_POST["editTitle"];
	$priv = $_POST["editPrivacy"];
	$course = $_POST["editCourse"];
	$desc = $_POST["editDescription"];
	editGroup($group->groupId, $title, $priv, $course, $desc);

	$events = $_POST["eventCount"];
	for ($i = 0; $i < $events; $i++)
	{
		$si = (string)$i;
		$eid = $_POST["eventId$si"];
		$etitle = $_POST["eventTitle$si"];
		$etime = $_POST["eventTime$si"];
		$edesc = $_POST["eventDescription$si"];
		editEvent($eid, $etitle, $etime, $edesc);
	}
	header("Location: " . str_replace("&edit=1", "", $_SERVER['REQUEST_URI']) . "&m=group-updated");
}
?>