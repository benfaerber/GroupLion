<?php
// Login to the database
$servername = "localhost";

$dbname = "stun";
$username = "root";
$password = "";


// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>