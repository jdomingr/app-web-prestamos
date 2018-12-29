<?php

include_once('../to/CategoriaTO.php');

include_once('../logica/principal.php');

$idcategoria = $_POST['id_categoria'];
$nombreC= $_POST['nombreCategoria'];

$cat = new CategoriaTO();
$cat->setIdCategoria($idcategoria);
$cat->setNombre($nombreC);

$j= principal::getInstance();

 $j->actualizarCategoria($cat);

header("Location:listarCategorias.php?exito=0&exitoEditar=0&edit=1");
 

?>