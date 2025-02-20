<?php

	$servername = "localhost";
	$database = "fertilizer_management";
	$username = "root";
	$password = "";

	// Create connection

	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection

	if (mysqli_connect_errno()) {
		die("Connection failed: " . mysqli_connect_errno());
	}

	
?>


