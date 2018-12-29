<?php 
include('../to/ProductoTO.php');
include('../logica/principal.php');

$id = $_POST['id_producto'];
$variable = principal::getInstance();
$data = $variable->obtenerDatosProducto($id);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);

?>