<?php
include_once('../to/UsuarioTO.php');
include_once('../logica/principal.php');
//recibo los datos del formulario cliente


$correo= $_POST['email'];
$clave= $_POST['password'];


//creo el objeto usuario
$usuario= new UsuarioTO();
//empaqueto la informacion del usuario en el objeto
$usuario->setCorreo($correo);
$usuario->setClave($clave);


//derivar la trasacción a donde corresponde.---> a la logica

$controlador= principal::getInstance();

$controlador->verificarUsuario($usuario);




?>