<?php
session_start();

$inc =  $_SERVER['DOCUMENT_ROOT'] . "/include/";
$ROOT =  $_SERVER['DOCUMENT_ROOT'];

// Include model
foreach (glob($inc . "model/*.php") as $filename)
  include $filename;

// Include database modules
include $inc . "db/db.php";
include $inc . "db/db_user.php";

// Create the user object and run some security checks
include $inc . "ext/load_user.php";

// Set up error logging and redirects
include $inc . "ext/log_errors.php";
?>