<?php 

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'perpustakaan';
$port = 3306;

$conn = new mysqli($hostname, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("connection to database failed:" . $conn->connect_error);
}

?>