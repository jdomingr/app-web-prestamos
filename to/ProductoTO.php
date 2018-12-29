<?php

class ProductoTO{


    private $id_producto;
    private $nombre_producto;
    private $id_categoria;
    private $stock;
    private $url_imagen;
    private $nombre_categoria;


    function __construct(){
    }

    function setIdProducto($id_producto){
        $this->id_producto=$id_producto;
    }

    function getIdProducto(){
        return $this->id_producto;
    }

    function setNombreProducto($nombre_producto){
        $this->nombre_producto=$nombre_producto;
    }

    function getNombreProducto(){
        return $this->nombre_producto;
    }

    function setIdCategoria($id_categoria){
        $this->id_categoria=$id_categoria;
    }

    function getIdCategoria(){
        return $this->id_categoria;
    }

    function setStock($stock){
        $this->stock=$stock;
    }

    function getStock(){
        return $this->stock;
    }

    function setUrlImagen($url_imagen){
        $this->url_imagen=$url_imagen;
    }

    function getUrlImagen(){
        return $this->url_imagen;
    }
    

    function setNombreCategoria($nombre_categoria){
        $this->nombre_categoria=$nombre_categoria;
    }

    function getNombreCategoria(){
        return $this->nombre_categoria;
    }
}
