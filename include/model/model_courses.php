<?php

class SearchResult
{
	public $courseId;
	public $catalogId;
	public $courseTitle;
	public $courseSubject;
	public $courseInstructors;

	function __construct($courseId, $catalogId, $courseTitle, $courseSubject, $courseInstructorsString)
	{
		$this->courseId = $courseId;
		$this->catalogId = $catalogId;
		$this->courseTitle = $courseTitle;
		$this->courseSubject = $courseSubject;
		$this->courseInstructors = explode(";", $courseInstructorsString);
	}
}

class SubjectSearchResult
{
	public $subjectCode;
	public $subjectTitle;

	function __construct($subjectCode, $subjectTitle)
	{
		$this->subjectCode = $subjectCode;
		$this->subjectTitle = $subjectTitle;
	}
}

class Course
{
	public $courseId;
	public $catalogId;
	public $courseTitle;
	public $courseSubject;
	public $courseInstructor;
	public $couresInstructors;

	function __construct($courseId, $catalogId, $courseTitle, $courseSubject, $courseInstructor)
	{
		$this->courseId = $courseId;
		$this->catalogId = $catalogId;
		$this->courseTitle = $courseTitle;
		$this->courseSubject = $courseSubject;
		$this->courseInstructor = $courseInstructor;
	}
}

function courseToJs($course)
{
	$built = $course->courseId . ", '" . $course->catalogId . "', '" . $course->courseTitle . "', '" . $course->courseSubject . "', ";
	$instructors = $course->courseInstructors;
	for ($i = 0; $i < count($instructors); $i++)
		$instructors[$i] = "'" . $instructors[$i] . "'";
	$jsArray = "[" . join(",", $instructors) . "]";
	return $built . $jsArray;
}

?>