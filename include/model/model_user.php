<?php

class User
{
	public $userId;
	public $name;
	public $email;
	public $pfp;
	public $pfpFilename;
	public $privilege;
	public $firstName;
	public $verificationCode;

	function __construct($userId, $name, $email, $photoId, $privilege, $verificationCode)
	{
		$this->userId = $userId;
		$this->name = $name;
		$this->firstName = explode(" ", $name)[0];
		$this->email = $email;
		$this->pfp = $this->getFilename($photoId);
		$this->privilege = $privilege;
		$this->verificationCode = $verificationCode;
	}

	function getFilename($photoId)
	{
		$fn = "userPhotos/user_" . $photoId . ".png";
		$this->pfpFilename = $fn;
		if (file_exists($fn))
			return $fn;
		else
			return "userPhotos/default.png";
	}

	function isAdmin()
	{
		return $this->privilege == "ADMIN";
	}

	function isMod()
	{
		return $this->privilege == "MOD";
	}

	function isVerified()
	{
		return $this->privilege != "UNVERIFIED";
	}

	function isElevated()
	{
		return $this->isAdmin() || $this->isMod();
	}
}

?>