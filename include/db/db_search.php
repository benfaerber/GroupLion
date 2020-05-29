<?php

function likePad($param)
{
	return "%" . $param . "%";
}

function getSearchResults($term, $subject)
{
	global $db;
	$searchSql = "SELECT * FROM `courses` WHERE `course_subject` LIKE ? AND
	( `course_title` LIKE ? OR `course_catalog_id` LIKE ? ) ;";
	$safeQuery = $db->prepare($searchSql);

	$term = likePad($term);
	$subject = likePad($subject);
	$safeQuery->bind_param("sss", $subject, $term, $term);
	$safeQuery->execute();

	$queryResult = $safeQuery->get_result();

	$searchResults = Array();
	while ($row = $queryResult->fetch_assoc())
	{
		if (isset($row["course_catalog_id"]))
			$searchResult = new SearchResult($row["course_id"], $row["course_catalog_id"], $row["course_title"], $row["course_subject"], $row["course_instructors"]);
		else
			$searchResult = new SearchResult(-1, -1, "error", "err", "error");
		array_push($searchResults, $searchResult);
	}
	return $searchResults;
}

function getSubjectSearchResults($term)
{
	global $db;
	$searchSql = "SELECT * FROM `subjects` WHERE `subject_code` LIKE ? OR `subject_title` LIKE ? ORDER BY `subject_code`;";
	$safeQuery = $db->prepare($searchSql);

	$paddedTerm = likePad($term);
	$safeQuery->bind_param("ss", $paddedTerm, $paddedTerm);
	$safeQuery->execute();

	$queryResult = $safeQuery->get_result();

	$searchResults = Array();
	while ($row = $queryResult->fetch_assoc())
	{
		if (isset($row["subject_code"]))
			$searchResult = new SubjectSearchResult($row["subject_code"], $row["subject_title"]);
		else
			$searchResult = new SubjectSearchResult("err", "error");
		array_push($searchResults, $searchResult);
	}
	return $searchResults;
}

?>