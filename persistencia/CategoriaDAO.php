<?php
include_once('conexion.php');
session_start ();

class CategoriaDAO{
private $conexionBD;
private $idU;

function __construct(){
    $this->conexionBD= new conexion();
}

public function insertarCategoria($categoria){
    
    $link=$this->conexionBD->getConexion(); //conexion a la bd
    
    $query="INSERT INTO categoria (nombre,id_usuario) VALUES('".$categoria->getNombre()."','".$categoria->getIdUsuario()."')";


    mysqli_query($link,$query) or die(mysqli_error()); //ejecuto la query
    mysqli_close($link);
}
    
    
    public function getCategorias(){
    $vectorData = null;
    $idU = $_SESSION["id_usuario"];    
     $link=$this->conexionBD->getConexion();
     $query = "SELECT * FROM categoria WHERE id_usuario = ".$idU;
     $resultado = mysqli_query($link, $query);
     $i=0;
     while($row=mysqli_fetch_array($resultado)){
        
        $categoria = new CategoriaTO(); 
        $categoria->setIdCategoria($row['id_categoria']); 
        $categoria->setNombre($row['nombre']); 
        $categoria->setIdUsuario($row['id_usuario']); 
       
    
        $vectorData[$i]=$categoria;
        $i++;
    }
    mysqli_close($link);
    return $vectorData;
}
    

     public function borrarCategoria($categoria){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
        $query = "DELETE FROM categoria WHERE id_categoria =".$categoria->getIdCategoria().";";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }
    
    
    public function obtenerCategoria($categoria){
    $vectorData;
     $link=$this->conexionBD->getConexion();
     $query = "SELECT nombre FROM categoria WHERE id_categoria =".$categoria->getIdCategoria().";";
      
        
        $resultado = mysqli_query($link,$query) or die (mysqli_error());

        $row=mysqli_fetch_row($resultado);
        return $row;
}
    
    public function getlacategoria($id){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT id_categoria,nombre FROM categoria WHERE id_categoria = ".$id;
        $resultado = mysqli_query($link,$query) or die (mysqli_error());

        $row=mysqli_fetch_row($resultado);
       
        
        mysqli_close($link);
        return $row;
        
    }
    
    
     public function obCategoria($categoria){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT id_categoria,nombre FROM categoria WHERE id_categoria =".$categoria->getIdCategoria().";";
        $resultado = mysqli_query($link,$query) or die (mysqli_error());

        $row=mysqli_fetch_row($resultado);
       
        
        mysqli_close($link);
        return $row;
        
    }
    
     public function actualizarCat($categoria){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
       
        $query = "UPDATE categoria SET nombre = '".$categoria->getNombre()."' WHERE  id_categoria = '".$categoria->getIdCategoria()."';";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }
    

}





?>