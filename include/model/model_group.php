<?php

class Group
{
	public $groupId;
	public $title;
	public $forCourse;
	public $admin;
	public $membersId;
	public $members;
	public $privacy;
	public $inviteCode;
	public $description;

	public $PRIVACY_DELETED = 0;
	public $PRIVACY_PUBLIC = 1;
	public $PRIVACY_PRIVATE_VISIBLE = 2;
	public $PRIVACY_PRIVATE_INVISIBLE = 3;

	function __construct($groupId, $title, $forCourseId, $adminId, $membersString, $privacy, $inviteCode, $description)
	{
		$this->groupId = $groupId;
		$this->title = $title;
		$this->forCourse = getCourse($forCourseId);
		$this->admin = getUser($adminId);

		if (isset($membersString) && $membersString != "")
		{
			$this->membersId = array();
			$strArray = explode(";", $membersString);
			$strArray = array_slice($strArray, 0, -1);
			foreach ($strArray as &$elem)
				array_push($this->membersId, (int)$elem);
		}
		else
		{
			$this->membersId = array();
		}

		$this->privacy = $privacy;
		$this->inviteCode = $inviteCode;
		$this->description = $description;
	}

	// Return user objects for all members of the group
	function getMembers()
	{
		$this->members = array();
		foreach ($this->membersId as &$currentId)
			array_push($this->members, getUser($currentId));
		return $this->members;
	}

	function getMemberNames()
	{
		if (count($this->members) == 0)
			return $this->admin->name;
		else if (count($this->members) == 1)
			return $this->admin->name . " and " . $this->members[0]->name;

		$built = $this->admin->name . ", ";
		$memberNames = array();
		$trimmedArray = array_splice($this->members, 0, -1);
		$lastName = $this->members[count($this->members)-1]->name;
		foreach ($trimmedArray as &$member)
		{
			array_push($memberNames, $member->name);
		}
		$built .= implode(", ", $memberNames);
		$built .= ", and " . $lastName;
		return $built;
	}

	function getMemberCount()
	{
		return count($this->membersId)+1;
	}

	function isAdmin($userId)
	{
		return $this->admin->userId == $userId;
	}

	function isMember($userId)
	{
		return in_array($userId, $this->membersId);
	}

	function isInvolved($userId)
	{
		return $this->isAdmin($userId) || $this->isMember($userId);
	}

	function getPrivacyTitle()
	{
		if ($this->privacy == $this->PRIVACY_DELETED)
			return "Deleted";
		if ($this->privacy == $this->PRIVACY_PUBLIC)
			return "Public";
		if ($this->privacy == $this->PRIVACY_PRIVATE_VISIBLE)
			return "Private";
		if ($this->privacy == $this->PRIVACY_PRIVATE_INVISIBLE)
			return "Private and invisible";
		return "";
	}

	function isVisible()
	{
		$notPrivate = $this->privacy != $this->PRIVACY_PRIVATE_INVISIBLE;
		$notDeleted = $this->privacy != $this->PRIVACY_DELETED;
		return $notPrivate && $notDeleted;
	}
}

?>