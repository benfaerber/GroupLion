<?php
include "include/base.php";
include $inc . "db/db_search.php";

function validateParams()
{
	if (isset($_GET["t"]) && isset($_GET["q"]))
	{
		if ($_GET["t"] != "subject" && $_GET["t"] != "course")
			return false;

		if ($_GET["t"] == "course")
		{
			if (strlen($_GET["q"]) < 4 || strlen($_GET["q"]) > 50)
				return false;

			if (!isset($_GET["s"]))
				return false;
		}
		else
		{
			if (strlen($_GET["q"]) < 2 || strlen($_GET["q"]) > 50)
				return false;
		}

		return true;
	}
	else
	{
		return false;
	}
}

if (validateParams())
{
	if ($_GET["t"] == "course")
	{

		$searchResults = getSearchResults($_GET["q"], $_GET["s"]);
		for ($i = 0; $i < count($searchResults); $i++)
		{
			$result = $searchResults[$i];
?>

<div class="searchResult" onclick="addCourse(<?= courseToJs($result); ?>)">
	<span class="courseSubject"><?= $result->courseSubject; ?></span>
	<span class="catalogId"><?= $result->catalogId; ?></span>
	<span class="courseTitle"><?= $result->courseTitle; ?></span>
</div>

<?php
		}
	}
	else if ($_GET["t"] == "subject")
	{
		$searchResults = getSubjectSearchResults($_GET["q"]);
		for ($i = 0; $i < count($searchResults); $i++)
		{
			$result = $searchResults[$i];
?>

<div class="subjectSearchResult" onclick="setSubject(this)">
	<span class="subjectCode"><?= $result->subjectCode; ?></span>
	<span class="subjectTitle"><?= $result->subjectTitle; ?></span>
</div>

<?php
		}
	}
}

?>