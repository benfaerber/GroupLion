<?php

function stringToEpoch($str)
{
	// 03/05/2020  03:30 am
	echo $str;
	$parts = explode(" ", $str);
	$date = explode("/", $parts[0]);
	$month = intval($date[0]);
	$day = intval($date[1]);
	$year = intval($date[2]);

	$time = explode(":", $parts[1]);
	$isPm = $parts[2] == "pm";

	$hour = intval($time[0]);
	if ($isPm)
		$hour += 12;
	$minute = intval($time[1]);

	return mktime($hour, $minute, 0,$month, $day, $year);
}

function createEvent($groupId, $title, $description, $atTime)
{
	global $db;
	$sql = "INSERT INTO `events` 
	(`group_id`, `event_title`, `event_description`, `event_time`)
	VALUES (?, ?, ?, ?);";
	$query = $db->prepare($sql);

	$query->bind_param("issi", $groupId, $title, $description, $atTime);
	if (!$query->execute())
		echo $query->error;
}

//editEvent($eid, $etitle, $etime, $edesc);
function editEvent($id, $title, $time, $description)
{
	global $db;
	$sql = "UPDATE `events` SET
	`event_title` = ?,
	`event_time` = ?,
	`event_description` = ?
	WHERE `event_id` = ?;";
	$query = $db->prepare($sql);
	$query->bind_param("sssi", $title, $time, $description, $id);
	
	if (!$query->execute())
		echo "Error: " . $query->error;
}

function getEvents($groupId)
{
	global $db;
	$sql = "SELECT * FROM `events` WHERE `group_id` LIKE ? ORDER BY `event_time` DESC;";

	$query = $db->prepare($sql);
	$query->bind_param("i", $groupId);
	$query->execute();

	$events = array();

	$queryResult = $query->get_result();
	while ($r = $queryResult->fetch_assoc())
	{
		$event = new Event($r["event_id"],  $r["group_id"], $r["event_title"], $r["event_description"], $r["event_rsvp_list"], $r["event_time"]);
		array_push($events, $event);
	}
	return $events;
}

function getEvent($eventId)
{
	global $db;
	$sql = "SELECT * FROM `event` WHERE `event_id` LIKE ? ;";
	$query = $db->prepare($sql);

	$query->bind_param("i", $eventId);
	$query->execute();

	$queryResult = $query->get_result();
	$r = $queryResult->fetch_assoc();
	return new Event($r["event_id"],  $r["group_id"], $r["event_title"], $r["event_description"], $r["event_rsvp_list"], $r["event_time"]);
}

?>