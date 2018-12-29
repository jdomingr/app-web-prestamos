<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'bd_interfaces';
//Conectamos y seleccionamos la base de datos
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($db->connect_error) {
 die("Conexión fallida: " . $db->connect_error);
}

?>