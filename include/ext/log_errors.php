<?php

function siteError($errorCode)
{
	header("Location: index.php?m=$errorCode");
	die();
}

function siteErrorPage($errorCode, $page)
{
	header("Location: $page.php?m=$errorCode");
	die();
}

// Show errors verbose
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>