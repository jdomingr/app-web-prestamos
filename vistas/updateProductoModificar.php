<?php 
include('../to/ProductoTO.php');
include('../logica/principal.php');
$producto = new ProductoTO();
$id_producto = $_POST['producto_id'];
$nombre = $_POST['nombre_producto'];
$stock = $_POST['stock_producto'];
$categoria = $_POST['categoria_producto'];
$url_imagen = $_POST['url_imagen_producto'];

$producto->setNombreProducto($nombre);
$producto->setStock($stock);
$producto->setIdCategoria($categoria);


$producto->setUrlImagen($url_imagen);
$producto->setIdProducto($id_producto);
$variable = principal::getInstance();
$variable->updateProducto($producto);


?>