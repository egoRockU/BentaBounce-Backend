<?php 

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$username = "root";
$password = "";
$database = "bentabounce_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>