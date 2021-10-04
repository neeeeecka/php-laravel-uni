<?php
$servername = "localhost";
$username = "root";
$password = ""; //toor
$dbname = "btuthu15";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo $conn->connect_error;
}