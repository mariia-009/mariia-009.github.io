<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$dbname = "dnipro_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Помилка підключення: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>