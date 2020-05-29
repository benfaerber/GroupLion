<?php

function getCount($table)
{
	global $db;
	// WARNING: SQL INJECTION CAN BE PERFORMED ON THIS QUERY
	$sql = "SELECT count(*) FROM `" . $table . "`;";
	$query = $db->prepare($sql);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	return $row["count(*)"];
}

function getFiles()
{
	$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("."));

	$files = array(); 

	foreach ($rii as $file)
	{
	    if ($file->isDir()) 
	    	continue;

	    // Exclude vendor code
	    if (strstr($file->getPathname(), "vendor") == false)
	    	$files[] = $file->getPathname(); 
	}
	return $files;
}

?>