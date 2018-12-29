<?php
class Conexion{


    private $db = "bd_interfaces";
    private $host = "localhost";
    private $user = "root";
    private $password = "";


    function __construct(){

    }


    public function getConexion(){
        
        $conex=mysqli_connect($this->host,$this->user,$this->password,$this->db);
        return $conex;
    }
    
}