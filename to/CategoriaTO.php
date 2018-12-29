<?php

class CategoriaTO{

    private $id_categoria;
    private $nombre;
    private $id_usuario;


    function __construct(){

    }

    //Getters and setters
    function getIdCategoria(){
        return $this->id_categoria;
    }

    function setIdCategoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }


    function getNombre(){
        return $this->nombre;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getIdUsuario(){
        return $this->id_usuario;
    }

    function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
}