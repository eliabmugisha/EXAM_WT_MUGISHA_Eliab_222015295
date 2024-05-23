<?php
// Database credentials
$hostname = "localhost";
$username = "mugisha";
$password = "eliab@2020";
$database = "online_relationship_counseling_platform";

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>


