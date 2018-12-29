<?php

session_start ();
include_once('../to/PrestamoTO.php');
include_once('../to/ProductoTO.php');
include_once('../to/Prestamo_has_ProductoTO.php');
include_once('../logica/principal.php');


$nombre= $_POST['nombre'];
$categoria= $_POST['categoria'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
//$fechaprestamo = date('Y-m-d'); 
$fechalimdev = $_POST['flimitedev'];
$idUsuario=$_SESSION["id_usuario"];
$devolucion = null;


$con= principal::getInstance();
$cantStock = $con->consultaStock($producto);

if($cantidad>$cantStock){
    
    header("Location:listarPrestamos.php?exito=0&mod=0&elim=0&error=1&stock=".$cantStock);

}else{
$prestamo= new PrestamoTO();   

//$prestamo->setFechaPrestamo($fechaprestamo);
$prestamo->setFechaDevolucion($devolucion);
$prestamo->setNombre($nombre);
$prestamo->setCantidad($cantidad);
$prestamo->setIdUsuario($idUsuario);
$prestamo->setFechaLimiteDevolucion($fechalimdev);


$controlador= principal::getInstance();
$idprestamo = $controlador->ingresarPrestamo($prestamo);
    
$prestamo_producto = new Prestamo_has_ProductoTO();
  
    $prestamo_producto->setIdPrestamo($idprestamo);
    $prestamo_producto->setIdProducto ($producto); 
    
$controlador2= principal::getInstance();
$controlador2->ingresarPrestamoProducto($prestamo_producto);
    

$nuevoStock = $cantStock - $cantidad;
    
$productos = new ProductoTO();
    
$productos->setIdProducto($producto);
$productos->setStock($nuevoStock);
    
$controlador3= principal::getInstance();
$controlador3->actualizarStock($productos); 
    
    
}

?>