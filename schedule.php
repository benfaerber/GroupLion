<html>
	<head>
		<title>Search Page</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<body>
<?php
include "include/base.php";
include $inc . "db/db_schedule.php";
include $inc . "security/signed_in_only.php";
include "header.php";

function isValid()
{
	if (isset($_POST["courseCount"]) && $_POST["courseCount"] != "")
	{
		$courseCount = $_POST["courseCount"]-1;

		for ($i = 0; $i < $courseCount; $i++)
		{
			$postIndex = "course_id_" . ((string)$i);
			$currentCourse = $_POST[$postIndex];
			if (!isset($currentCourse))
				return false;

			if ($currentCourse < 1)
				return false;
		}
		return true;
	}
	else
	{
		return false;
	}
}

function createNewCourse($courseId, $courseInstructor)
{
	return new Course($courseId, null, null, null, $courseInstructor);
}

// Save schedule
if (isset($_POST["submitSchedule"]))
{
	if (isValid())
	{
		// Save the schedule to the user database
		$courseCount = $_POST["courseCount"];
		$courses = array();
		for ($i = 0; $i < $courseCount; $i++)
		{
			$postIndex = (string)($i);
			$currentId = $_POST["course_id_" . $postIndex];
			$currentInstructor = $_POST["course_instructor_" . $postIndex];
			$currentCourse = createNewCourse($currentId, $currentInstructor);
			array_push($courses, $currentCourse);
		}

		updateSchedule($user->userId, $courses);
	}
}
?>
	<!-- Search -->
	<input type="text" size="10" id="subjectInput" placeholder="Subject" onkeyup="showResult(this.value, 'subject')">
	<input type="text" size="30" id="courseInput" placeholder="Course Title or Catalog ID" onkeyup="showResult(this.value, 'course')">
	<h3>Subject Search Results</h3>
	<div id="subjectSearchResults">Please enter a search</div>
	<h3>Course Search Results</h3>
	<div id="courseSearchResults">Please enter a search</div>

	<!-- Schedule -->
	<h3>Schedule</h3>
	<form action="schedule.php" method="post">
		<input type="hidden" value="" id="courseCount" name="courseCount">
		<div id="schedule"></div>
		<input type="submit" value="Save" name="submitSchedule">
	</form>

	<?php scheduleAsHtml($user->userId); ?>

	<script src="vendor/jquery.min.js"></script>
	<script src="js/schedule.js"></script>
	<script>
		addAllCourses();
	</script>
</body>
</html> 