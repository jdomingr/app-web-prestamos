<?php 
include('../to/ProductoTO.php');
include('../logica/principal.php');

$id = $_POST['id_producto'];
$variable = principal::getInstance();
$data = $variable->deleteProducto($id);
header('Content-Type: application/json');
echo json_encode($data);

?>