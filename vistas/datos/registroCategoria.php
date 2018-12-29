<?php
include_once('../to/CategoriaTO.php');
include_once('../logica/principal.php');
//recibo los datos del formulario cliente
session_start();

$nombre= $_POST['nombre'];
$id_usuario=$_SESSION['id_usuario'];

//$id_usuario= $_POST['id_usuario'];


//creo el objeto usuario
$categoria= new CategoriaTO();
//empaqueto la informacion del usuario en el objeto
$categoria->setNombre($nombre);
$categoria->setIdUsuario($id_usuario);



//derivar la trasacción a donde corresponde.---> a la logica

$controlador= principal::getInstance();

$controlador->guardarCategoria($categoria);

header("Location: login.php");

?>