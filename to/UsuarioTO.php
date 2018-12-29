<?php

class UsuarioTO{

    private $id_usuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;

    function __construct(){

    }

    //Getters and setters
    function getIdUsuario(){
        return $this->id_usuario;
    }

    function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }


    function getNombre(){
        return $this->nombre;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getApellido(){
        return $this->apellido;
    }

    function setApellido($apellido){
        $this->apellido = $apellido;
    }

    function getCorreo(){
        return $this->correo;
    }

    function setCorreo($correo){
        $this->correo = $correo;
    }

    function getClave(){
        return $this->clave;
    }

    function setClave($clave){
        $this->clave = $clave;
    }
}