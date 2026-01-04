<?php
$host     = "sqlXXX.epizy.com";   // replace with InfinityFree host
$username = "epiz_12345678";      // your MySQL username
$password = "your_db_password";   // your MySQL password
$database = "epiz_12345678_db";   // your database name

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
