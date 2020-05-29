<?php

function updateSchedule($userId, $courses)
{
	global $db;
	$sql = "UPDATE `schedules` SET
	`course_id_1` = ?,
	`course_id_2` = ?,
	`course_id_3` = ?,
	`course_id_4` = ?,
	`course_id_5` = ?,
	`course_id_6` = ?,
	`course_id_7` = ?,
	`course_id_8` = ?,
	`course_id_9` = ?,
	`course_id_10` = ?,
	`course_instructor_1` = ?,
	`course_instructor_2` = ?,
	`course_instructor_3` = ?,
	`course_instructor_4` = ?,
	`course_instructor_5` = ?,
	`course_instructor_6` = ?,
	`course_instructor_7` = ?,
	`course_instructor_8` = ?,
	`course_instructor_9` = ?,
	`course_instructor_10` = ?
	 WHERE `user_id` = ? ; ";
	$query = $db->prepare($sql);

	$cIds = array();
	$cIns = array();
	for ($i = 0; $i < 10;$i++)
	{
		if ($i < count($courses))
		{
			array_push($cIds, $courses[$i]->courseId);
			array_push($cIns, $courses[$i]->courseInstructor);
		}
		else
		{
			array_push($cIds, 0);
			array_push($cIns, "");
		}
	}

	$query->bind_param("iiiiiiiiiissssssssssi",
		$cIds[0], $cIds[1], $cIds[2], $cIds[3], $cIds[4], $cIds[5], $cIds[6], $cIds[7], $cIds[8], $cIds[9],
		$cIns[0], $cIns[1], $cIns[2], $cIns[3], $cIns[4], $cIns[5], $cIns[6], $cIns[7], $cIns[8], $cIns[9],
		$userId);
	$query->execute();
}

function createSchedule($userId)
{
	global $db;
	$sql = "INSERT INTO `schedules` (`user_id`) VALUES (?); ";
	$query = $db->prepare($sql);

	$query->bind_param("i", $userId);
	$query->execute();
}

function getCourse($courseId)
{
	global $db;
	$sql = "SELECT * FROM `courses` WHERE `course_id` = ? ;";
	$query = $db->prepare($sql);

	$query->bind_param("i", $courseId);
	$query->execute();

	$queryResult = $query->get_result();
	$r = $queryResult->fetch_assoc();

	$course =  new Course($r["course_id"],  $r["course_catalog_id"], $r["course_title"], $r["course_subject"], $r["course_instructors"]);
	$course->courseInstructors = explode(";", $r["course_instructors"]);
	return $course;
}

// Returns an array of courses
function getSchedule($userId)
{
	global $db;
	$sql = "SELECT * FROM `schedules` WHERE `user_id` = ? ;";
	$query = $db->prepare($sql);
	$query->bind_param("i", $userId);
	$query->execute();

	$courses = array();
	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	for ($i = 0; $i < 10; $i++)
	{
		$strIndex = (string)($i+1);
		if (isset($row["course_id_" . $strIndex]) && $row["course_id_" . $strIndex] != 0)
		{
			$currentCourse = getCourse($row["course_id_" . $strIndex]);
			$currentCourse->courseInstructor = $row["course_instructor_" . $strIndex];
			array_push($courses, $currentCourse);
		}
		else
		{
			break;
		}
	}
	return $courses;
}

function scheduleAsHtml($userId)
{
	$courses = getSchedule($userId);
?>

	<div style="display:none" id="toAddContainer">
		<?php
		//Load schedule
		foreach ($courses as &$currCourse)
		{
			$instructorString = implode(";", $currCourse->courseInstructors);
		?>

			<div style="display:none" class="courseToAdd">
				<span class="toAddCourseId"><?= $currCourse->courseId; ?></span>
				<span class="toAddCatalogId"><?= $currCourse->catalogId; ?></span>
				<span class="toAddTitle"><?= $currCourse->courseTitle; ?></span>
				<span class="toAddSubject"><?= $currCourse->courseSubject; ?></span>
				<span class="toAddInstructors"><?= $instructorString; ?></span>
				<span class="toAddInstructor"><?= $currCourse->courseInstructor; ?></span>
			</div>
			
		<?php
		}
		?>
	</div>

<?php } ?>