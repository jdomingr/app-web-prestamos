<?php
include_once('../to/PrestamoTO.php');
include_once('../to/ProductoTO.php');
include_once('../to/Prestamo_has_ProductoTO.php');
include_once('../logica/principal.php');

$id = $_POST['id_prestamo'];

$prestamo= new PrestamoTO();

$prestamo->setIdPrestamo($id);


$jefe= principal::getInstance();

$unprestamo = $jefe->obtenerUnPrestamo($prestamo);

$producto = $jefe->obtenerelproducto($prestamo);

$idcategoria = $producto[2];
    
$categoria = $jefe->obtenerlacategoria($idcategoria);

$array = array("id_prestamo" => $unprestamo[0],"nombre"=>$unprestamo[3],"cantidad" =>$unprestamo[4],"fecha_limite_devolucion"=>$unprestamo[6],
              "id_categoria"=>$categoria[0],"nombreCategoria"=>$categoria[1],"id_producto"=>$producto[0],"nombreProducto"=>$producto[1]);

echo json_encode($array);

 
?>
