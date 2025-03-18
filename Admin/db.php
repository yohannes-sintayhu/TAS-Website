<?php
// Database configuration
$hostname = "localhost";
$username = "root";
$password = "";
$database = "tasdb";

// Create a connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>