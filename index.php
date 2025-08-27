<?php
// index.php — main entry. Ensure NOTHING is sent before this block (no BOM/whitespace).
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>GYM To Train Fitness</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- your global stylesheet if any -->
	<link rel="stylesheet" href="style.css">
	<!-- Font Awesome for icons -->
	<script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>
	<style>
		body {
			margin: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			color: #ffffff;
			background: #0f0f0f;
		}
	</style>
</head>

<body>

	<?php include 'nav.php'; ?>
	<?php include 'Coverpage.php' ?>
	<?php include 'package.php'; ?>
	<?php include 'footer.php'; ?>

</body>

</html>