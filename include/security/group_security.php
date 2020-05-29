<?php

function groupSecurityPrecheck()
{
	if (!isset($_GET["id"]))
		siteErrorPage("error", "groups");

	if (!groupExists($_GET["id"]))
		siteErrorPage("error", "groups");
}

function groupSecurityPostcheck()
{
	global $group;
	if ($group->privacy == $group->PRIVACY_PRIVATE_INVISIBLE)
	{
		if ($loggedIn)
		{
			if (!$group->isInvolved($user->userId))
				siteErrorPage("permission-denied", "groups");
		}
		else
		{
			siteErrorPage("permission-denied", "groups");
		}
	}

	if ($group->privacy == $group->PRIVACY_DELETED)
		siteErrorPage("group-was-deleted", "groups");
}
?>