<?php
$host = "localhost";
$user = "root";
$password = "188490";
$database = "escuela";

$conexion = new mysqli(
    $host,
    $user,
    $password,
    $database
);

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

//echo "Connected successfully";
?>

