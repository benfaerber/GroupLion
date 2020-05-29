<html>
	<head>
		<title>Analytics</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<?php

include "include/base.php";
include $inc . "db/db_analytics.php";
include $inc . "security/elevated_only.php";
include "header.php";


$files = getFiles();
$totalLines = 0;
$incFolderLines = 0;
?>
		<h2>Analytics</h2>

		<h3>Lines of Code Counter</h3>
		<p>
<table>
	<tr>
		<th>Filename</th>
		<th>Lines of Code</th>
	</tr>

	<?php
	foreach ($files as &$file)
	{
		$file = str_replace("./", "", $file);
		$file = str_replace(".\\", "", $file);

		if (strpos($file, ".php") !== false || strpos($file, ".html") !== false || strpos($file, ".js") !== false || strpos($file, ".css") !== false) 
		{
			$loadedFile = fopen($file, "r") or die("Unable to open file!");
			$read = fread($loadedFile, filesize($file));
			$lineCount = count(explode("\n", $read));
			fclose($loadedFile);
			$totalLines += $lineCount;
			if (strpos( $file, "include\\") !== false || strpos( $file, "include/") !== false)
				$incFolderLines += $lineCount;
		?>

				<tr>
					<td><?= $file; ?></td>
					<td><?= (string)$lineCount; ?><td>
				</tr>

		<?php
		}
	}
?>
				<tr>
					<td>Include Folder Lines</td>
					<td><?= (string)$incFolderLines; ?><td>
				</tr>
				<tr>
					<td>Total Lines</td>
					<td><?= (string)$totalLines; ?><td>
				</tr>
			</table>
			</p>

		<h3>Counts</h3>
		<table>
			<tr>
				<th>Database</th>
				<th>Count</th>
			</tr>
			<tr>
				<td>Users</td>
				<td><?= getCount("users"); ?></td>
			</tr>
			<tr>
				<td>Groups</td>
				<td><?= getCount("groups"); ?></td>
			</tr>
			<tr>
				<td>Courses</td>
				<td><?= getCount("courses"); ?></td>
			</tr>
			<tr>
				<td>Subjects</td>
				<td><?= getCount("subjects"); ?></td>
			</tr>
		</table>
		
	</body>
</html>