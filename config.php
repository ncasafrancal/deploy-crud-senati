<?php

$host="localhost";
#$user="admin_ncasafranca";
$user="root";
#$password="Peru2025"; //Xampp = "" | Workbench = 1234
$password="1234"; //Xampp = "" | Workbench = 1234
$db="senati";
$port=3308;

$conexion = new mysqli($host, $user, $password, $db, $port);

if ($conexion->connect_error) {
    die("Connection failed!" . $conexion->connect_error);
}

?>