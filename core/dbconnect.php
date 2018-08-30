<?php
$servername = "sql201.epizy.com";
$username = "epiz_22637367";
$password = "aVRl6TW3cTBa";
$dbname = "epiz_22637367_omega_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>