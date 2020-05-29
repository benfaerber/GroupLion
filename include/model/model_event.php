<?php

class Event
{
	public $eventId;
	public $groupId;
	public $title;
	public $description;
	public $rsvpIds;
	public $rsvpUsers;
	public $epochTime;

	function __construct($eventId, $groupId, $title, $descr, $rsvpString, $epochTime)
	{
		$this->eventId = $eventId;
		$this->groupId = $groupId;
		$this->title = $title;
		$this->description = $descr;
		$rsvpArr = explode(";", $rsvpString);
		array_pop($rsvpArr);
		$this->rsvpIds = $rsvpArr;
		$this->epochTime = $epochTime;
	}

	function getDay()
	{
		// Monday
		return date("l", $this->epochTime);
	}

	function getNiceDate()
	{
		//Monday the 22nd
		$dow = $this->getDay();
		$numberDay = date("jS", $this->epochTime);
		$time = $this->getTime();
		return $dow . " the " . $numberDay  . " at " . $time;
	}

	function getDate()
	{
		// 03/15/2002
		return date("m/d/Y", $this->epochTime);
	}

	function getTime()
	{
		// 3:30am
		// 'Merica Time Baby
		return date("g:ia", $this->epochTime);
	}

	function getDateTime()
	{
		return $this->getDate() . " " . $this->getTime();
	}

	function getEncodableTime()
	{
		return $this->getDate() . " " . date("g:i", $this->epochTime). " " . date("a", $this->epochTime);
	}

	function rsvpCount()
	{
		return count($this->rsvpIds);
	}

	function getRsvpString()
	{
		$c = $this->rsvpCount();
		return (string)$c . " " . ($c == 1 ? "person" : "people");
	}
}

?>