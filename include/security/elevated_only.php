<?php

if (!$loggedIn)
	siteError("permission-denied");

if (!$user->isElevated())
	siteError("permission-denied");

?>