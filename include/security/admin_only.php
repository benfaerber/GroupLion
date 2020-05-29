<?php

if (!$loggedIn)
	siteError("permission-denied");

if (!$user->isAdmin())
	siteError("permission-denied");

?>
