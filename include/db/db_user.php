<?php

function createUser($name, $email, $password)
{
	global $db;
	$sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`, `user_photo_id`, `user_verification_code`) VALUES
	(?, ?, ?, ?, ?);";
	$query = $db->prepare($sql);

	$photoId = getPhotoId();
	$verifyId = getVerificationCode();
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	$query->bind_param("sssss", $name, $email, $hashedPassword, $photoId, $verifyId);
	$query->execute();
	loginUser($email, $password);
	return getUserIdByDetails($email, $hashedPassword);
}

function getUserIdByDetails($email, $password)
{
	global $db;
	$sql = "SELECT `user_id` FROM `users` WHERE 
	`user_email` = ? AND `user_password` = ?;";
	$query = $db->prepare($sql);

	$query->bind_param("ss", $email, $password);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	return $row["user_id"];
}

function getVerificationCode() {
	$length = 10;
  $characters = "abcdefghijklmnopqrstuvwxyz";
  $randomString = "";
  for ($i = 0; $i < $length; $i++)
  	$randomString .= $characters[rand(0, strlen($characters) - 1)];
  return $randomString;
}


function getPhotoId() {
	$length = 10;
  $characters = "abcdefghijklmnopqrstuvwxyz";
  $randomString = "";
  for ($i = 0; $i < $length; $i++)
  	$randomString .= $characters[rand(0, strlen($characters) - 1)];
  return $randomString;
}

function getUser($userId)
{
	global $db;
	$sql = "SELECT * FROM `users` WHERE `user_id` = ?;";
	$query = $db->prepare($sql);
	$query->bind_param("i", $userId);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();

	if (!isset($row["user_id"]))
		return null;

	return new User($row["user_id"], $row["user_name"], $row["user_email"], $row["user_photo_id"], $row["user_privilege"], $row["user_verification_code"]);
}

function changePrivilege($userId, $changeTo)
{
	global $db;
	$sql = "UPDATE `users` SET `user_privilege` = ? WHERE `user_id` = ?;";
	$query = $db->prepare($sql);
	$query->bind_param("si", $changeTo, $userId);
	$query->execute();
}

function verifyUser($userId)
{
	changePrivilege($userId, "USER");
}

function modUser($userId)
{
	changePrivilege($userId, "MOD");
}

function loginUser($email, $password)
{
	global $db;
	$sql = "SELECT * FROM `users` WHERE `user_email` = ?;";
	$query = $db->prepare($sql);

	$query->bind_param("s", $email);
	$query->execute();
	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();

	if (isset($row["user_id"]))
	{
		if (password_verify($password, $row["user_password"]))
		{
			$_SESSION["user_id"] = $row["user_id"];
			return true;
		}
	}

	return false;
}

function verifyPassword($userId, $password)
{
	global $db;
	$sql = "SELECT `user_password` FROM `users` WHERE `user_id` = ?;";
	$query = $db->prepare($sql);

	$query->bind_param("i", $userId);
	$query->execute();
	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	if (isset($row["user_password"]))
	{
		if (password_verify($password, $row["user_password"]))
			return true;
	}

	return false;
}

function changePassword($userId, $newPassword)
{
	global $db;
	$sql = "UPDATE `users` SET `user_password` = ? WHERE `user_id` = ?;";
	$query = $db->prepare($sql);

	$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
	$query->bind_param("si", $hashedPassword, $userId);
	$query->execute();
}

function isEmailRegistered($email)
{
	global $db;
	$sql = "SELECT `user_id` FROM `users` WHERE `user_email` = ?;";
	$query = $db->prepare($sql);

	$query->bind_param("s", $email);
	$query->execute();

	$queryResult = $query->get_result();
	$row = $queryResult->fetch_assoc();
	return isset($row["user_id"]);
}

?>