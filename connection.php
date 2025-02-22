<?php

$servername = "localhost";
$database = "fds1a1";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database Connected Successfully!"; // Remove this after testing

?>
