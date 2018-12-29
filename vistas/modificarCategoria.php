<?php
include_once('../to/CategoriaTO.php');
include_once('../logica/principal.php');
//recibo los datos del formulario cliente


$id= $_POST['id_categoria'];


//creo el objeto usuario
$categoria= new CategoriaTO();
//empaqueto la informacion del usuario en el objeto
$categoria->setIdCategoria($id);


$controlador= principal::getInstance();

$lacategoria = $controlador->obtlacategoria($categoria);

$array = array("id_categoria" => $lacategoria[0],"nombre_categoria"=>$lacategoria[1]);

echo json_encode($array);



?>