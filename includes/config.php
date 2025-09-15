<?php
$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP password
$dbname = "hotel_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
?>
