<?php
include_once('conexion.php');
class Prestamo_has_ProductoDAO{
private $conexionBD;



function __construct(){
    $this->conexionBD= new conexion();
}

public function guardarPrestamo_Producto($prestamo_producto){
    
    $link=$this->conexionBD->getConexion(); //conexion a la bd
    
    $query="INSERT INTO prestamo_has_producto (id_prestamo,id_producto) VALUES('".$prestamo_producto->getIdPrestamo()."','".$prestamo_producto->getIdProducto()."')";
    
    mysqli_query($link,$query) or die(mysqli_error()); //ejecuto la query
    mysqli_close($link);
}
    
     public function obtenernombreproducto($id){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT id_producto FROM prestamo_has_producto WHERE id_prestamo = ".$id;
        $resultado = mysqli_query($link,$query) or die (mysqli_error());
        $row=mysqli_fetch_row($resultado);
        
        $idprod = $row[0];    
        mysqli_close($link);
         
         
        $link2 = $this->conexionBD->getConexion(); 
        $query2 = "SELECT nombre_producto FROM producto WHERE id_producto = ".$idprod;
        $resultado2 = mysqli_query($link2,$query2) or die (mysqli_error());
        $row2=mysqli_fetch_row($resultado2);
        
        $nombre = $row2[0];
        mysqli_close($link2);
        return $nombre;
    }
    
     public function getstock($id){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT id_producto FROM prestamo_has_producto WHERE id_prestamo = ".$id;
        $resultado = mysqli_query($link,$query) or die (mysqli_error());
        $row=mysqli_fetch_row($resultado);
        
        $idprod = $row[0];    
        mysqli_close($link);
         
         
        $link2 = $this->conexionBD->getConexion(); 
        $query2 = "SELECT stock FROM producto WHERE id_producto = ".$idprod;
        $resultado2 = mysqli_query($link2,$query2) or die (mysqli_error());
        $row2=mysqli_fetch_row($resultado2);
        
        $stock = $row2[0];
        
           $producto = new ProductoTO();
    
            $producto->setIdProducto($idprod);
            $producto->setStock($stock);
        
         mysqli_close($link2);
        return $producto;
    }
    
    public function getelproducto($prestamo){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT id_producto FROM prestamo_has_producto WHERE id_prestamo = ".$prestamo->getIdPrestamo().";";
        $resultado = mysqli_query($link,$query) or die (mysqli_error());
        $row=mysqli_fetch_row($resultado);
        
        $idprod = $row[0];    
        mysqli_close($link);
         
         
        $link2 = $this->conexionBD->getConexion(); 
        $query2 = "SELECT id_producto,nombre_producto,id_categoria FROM producto WHERE id_producto = ".$idprod;
        $resultado2 = mysqli_query($link2,$query2) or die (mysqli_error());
        $row2=mysqli_fetch_row($resultado2);
        
        
        mysqli_close($link2);
        return $row2;
    }
    
    public function actualizarTR($idprestamo,$idproducto){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
       
        $query = "UPDATE prestamo_has_producto SET id_producto = '".$idproducto."' WHERE  id_prestamo = '".$idprestamo."';";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }
    
    
    
  
}

?>
