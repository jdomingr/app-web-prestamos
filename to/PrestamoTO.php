<?php

class PrestamoTO{

    private $id_prestamo;
    private $fecha_prestamo;
    private $fecha_devolucion;
    private $nombre;
    private $cantidad;
    private $id_usuario;
    private $fecha_limite_devolucion;
    private $nombre_producto;

    function __construct(){

    }

    //Getters and setters
    function getIdPrestamo(){
        return $this->id_prestamo;
    }

    function setIdPrestamo($id_prestamo){
        $this->id_prestamo = $id_prestamo;
    }


    function getFechaPrestamo(){
        return $this->fecha_prestamo;
    }

    function setFechaPrestamo($fecha_prestamo){
        $this->fecha_prestamo = $fecha_prestamo;
    }

    function getFechaDevolucion(){
        return $this->fecha_devolucion;
    }

    function setFechaDevolucion($fecha_devolucion){
        $this->fecha_devolucion = $fecha_devolucion;
    }

    function getNombre(){
        return $this->nombre;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getCantidad(){
        return $this->cantidad;
    }

    function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    function getIdUsuario(){
        return $this->id_usuario;
    }

    function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    
    function getFechaLimiteDevolucion(){
        return $this->fecha_limite_devolucion;
    }
    
    function setFechaLimiteDevolucion($fecha_limite_devolucion){
        $this->fecha_limite_devolucion=$fecha_limite_devolucion;
    }
    function getNombreProducto(){
        return $this->nombre_producto;
    }
    function setNombreProducto($nombre_producto){
        $this->nombre_producto=$nombre_producto;
    }
}