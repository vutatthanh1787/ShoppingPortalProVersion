<?php
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "root";
	$mysql_database = "shopping";
	$conn = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");
	// Change character set to utf8
	mysqli_set_charset($conn,"utf8");
?>