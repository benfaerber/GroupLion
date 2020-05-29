<?php

function uploadPfp($forUser)
{
	$file =	$forUser->pfpFilename;
	$imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["uploadPfpSubmit"]))
	{
			$check = getimagesize($_FILES["pfpUpload"]["tmp_name"]);
			if($check === false)
				return "This file is not an image.";
	}
	else
	{
		return "Please select and image";
	}

	$updating = false;
	if (file_exists($file))
		$updating = true;

	// Check file size
	if ($_FILES["pfpUpload"]["size"] > 500000)
			return "Sorry, your image is too large.";

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" )
		return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

	if (move_uploaded_file($_FILES["pfpUpload"]["tmp_name"], $file))
	{
		// Max the image the proper size
		resizeImage($file, 256, 256);
		if ($updating)
			return "UPDATE OK";
		else
			return "UPLOAD OK";
	}
	else
	{
			return "Sorry, there was an error uploading your file.";
	}
}


function resizeImage($source, $max_width, $max_height)
{
	/* [1 - INIT & SETTINGS] */
	$max_width = 256;
	$max_height = 256;
	// Image quality
	// JPG files - 0 is lowest, 100 is highest
	// PNG files - 0 no compression to 9 most compression
	$quality = ["jpg"=>100, "jpeg"=>100, "png"=>0];
	$allowed = ["bmp", "gif", "jpg", "jpeg", "png", "webp"];
	$ext = strtolower(pathinfo($source, PATHINFO_EXTENSION));
	$size = getimagesize($source);
	$pass = true;
	$error = "";

	/* [2 - FILE CHECKS] */
	// Invalid file type
	if (!in_array($ext, $allowed)) {
		$pass = false;
		$error = "$ext file type not allowed - $source";
	}
	// Invalid image
	if ($pass && $size == false) {
		$pass = false;
		$error = "$source is not a valid image file.";
	}
	// Error!
	if (!$pass) { die($error); }

	/* [3 - RESIZE] */
	// Resize only if source is larger than allow max
	$width = $size[0];
	$height = $size[1];
	if ($width>$max_width || $height>$max_height)
	{
		// Landscape image
		if ($width > $height) {
			$new_width = $max_width;
			$new_height = CEIL($height / ($width/$max_width));
		}
		// Square or portrait
		else {
			$new_height = $max_height;
			$new_width = CEIL($width / ($height/$max_height));
		}
		// Create new resized image
		$fn = "imagecreatefrom" . ($ext=="jpg"?"jpeg":$ext);
		$original = $fn($source);
		$resize = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		// Save resized to file
		$fn = "image" . ($ext=="jpg"?"jpeg":$ext);
		if (is_numeric($quality[$ext])) { $fn($resize, $source, $quality[$ext]); }
		else { $fn($resize, $source); }
		imagedestroy($original);
		imagedestroy($resize);
	}
	else
	{
		if (!copy($source, $source))
		{
			$pass = false;
			$error = "Error overwriting";
		}
	}
	return $pass ? "OK" : $error ;
}
?>