
<?php
include_once('../to/CategoriaTO.php');
include_once('../logica/principal.php');

header('Location: listarCategorias.php?edit=0');
$idCategoria=$_GET['idCategoria'];

$categoria= new CategoriaTO();

$categoria->setIdCategoria($idCategoria);
$jefe= principal::getInstance();
$jefe->eliminarCatego($categoria);

?>