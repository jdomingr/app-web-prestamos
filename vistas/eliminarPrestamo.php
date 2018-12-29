
<?php
include_once('../to/PrestamoTO.php');
include_once('../to/ProductoTO.php');
include_once('../to/Prestamo_has_ProductoTO.php');
include_once('../logica/principal.php');

$id = $_POST['id_prestamo'];

$prestamo= new PrestamoTO();

$prestamo->setIdPrestamo($id);


$jefe= principal::getInstance();

$cant = $jefe->obtenerPrestamo($id);

$producto = $jefe->getStock($id);

$idproducto = $producto->getIdProducto();
$stockActual = $producto->getStock();

$nuevoStock = $stockActual + $cant;

$productos = new ProductoTO();

$productos->setIdProducto($idproducto);
$productos->setStock($nuevoStock);

$jefe->actualizarStock2($productos); 


$jefe->eliminarPrestamo($prestamo);

 
?>

  