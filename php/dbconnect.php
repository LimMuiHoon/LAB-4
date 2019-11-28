<?php
$servername = "localhost";
$username 	= "tradebar_mytradebarteruser";
$password 	= "MY3JYy0R)+EN";
$dbname 	= "tradebar_mytradebarter(user)";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>