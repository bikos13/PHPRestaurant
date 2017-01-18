<?php

//DB Connection details

$host = "localhost";
$username = "root";
$password = "";
$database = "restaurant_db";

//MySQLP Connect
mysqli_connect($host, $username, $password, $database) or die("Failed to connect to database" . $conn->connect_error);

$mysqli = new mysqli($host,$username,$password,$database);
?>