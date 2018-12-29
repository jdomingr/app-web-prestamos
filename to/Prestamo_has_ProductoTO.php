<?php

class Prestamo_has_ProductoTO{

    private $id_prestamo;
    private $id_producto;

    function __construct(){

    }

    //Getters and setters
    function getIdPrestamo(){
        return $this->id_prestamo;
    }

    function setIdPrestamo($id_prestamo){
        $this->id_prestamo = $id_prestamo;
    }


    function getIdProducto(){
        return $this->id_producto;
    }

    function setIdProducto($id_producto){
        $this->id_producto = $id_producto;
    }
}