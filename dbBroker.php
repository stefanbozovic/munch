<?php

$host = "localhost";
$db = "munchmallow";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db);

if($conn->connect_errno){
    exit("Konekcija je neuspesna: " . $conn->connect_errno);
}
