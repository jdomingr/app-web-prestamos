<?php

include_once('../to/PrestamoTO.php');
include_once('../to/ProductoTO.php');
include_once('../to/Prestamo_has_ProductoTO.php');
include_once('../logica/principal.php');

$idprestamo = $_POST['id_prestamo'];
$nombre= $_POST['nombre'];
$categoria= $_POST['categoria'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad']; 
$fechalimdev = $_POST['flimitedev'];

$j= principal::getInstance();

$prest= new PrestamoTO();
$prest->setIdPrestamo($idprestamo);

$unproducto = $j->obtenerelproducto($prest);

$idP = $unproducto[0];

if($idP == $producto){

$prestamos= new PrestamoTO();   
    
    $prestamos->setIdPrestamo($idprestamo);
    $prestamos->setNombre($nombre);
    $prestamos->setCantidad($cantidad);
    $prestamos->setFechaLimiteDevolucion($fechalimdev);
    
    $j->actualizarPrest($prestamos);
    
    header("Location:listarPrestamos.php?exito=0&elim=0&error=0&stock=0&mod=1");

}else{
    
    $j->actualizarTablaRelacion($idprestamo,$producto);
    
    $prestam= new PrestamoTO();   
    
    $prestam->setIdPrestamo($idprestamo);
    $prestam->setNombre($nombre);
    $prestam->setCantidad($cantidad);
    $prestam->setFechaLimiteDevolucion($fechalimdev);
    
    $j->actualizarPrest($prestam);
    
    header("Location:listarPrestamos.php?exito=0&elim=0&error=0&stock=0&mod=1");
    
}

?>