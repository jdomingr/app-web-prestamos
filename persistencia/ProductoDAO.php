<?php
include_once("conexion.php");

class ProductoDAO{
    
    private $conexionBD;
    
    function __construct(){
        $this->conexionBD = new conexion();
    }
    
    public function insertarProducto($producto){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
        //Consulta
        $query = "INSERT INTO producto (id_producto, nombre_producto, id_categoria, stock, url_imagen)
                  VALUES('".$producto->getIdProducto()."', '".$producto->getNombreProducto()."', '".$producto->getIdCategoria()."','".$producto->getStock()."'
                  ,'".$producto->getUrlImagen()."')";
          
        //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
    }
    
    
    public function getProductos($id_usuario){
        $datos = null;
        $link = $this->conexionBD->getConexion();
        $query = "SELECT P.id_producto, P.nombre_producto, P.id_categoria, P.stock, P.url_imagen, C.nombre FROM producto AS P JOIN categoria AS C ON P.id_categoria = C.id_categoria WHERE C.id_usuario = ".$id_usuario." ;";
        $resultado = mysqli_query($link,$query) or die (mysqli_error());
        $i = 0;
        while($row=mysqli_fetch_array($resultado)){
            $producto = new ProductoTO();
            $producto->setIdProducto($row['id_producto']);
            $producto->setNombreProducto($row['nombre_producto']);
            $producto->setIdCategoria($row['id_categoria']);
            $producto->setStock($row['stock']);
            $producto->setUrlImagen($row['url_imagen']);
            $producto->setNombreCategoria($row['nombre']);
            $datos[$i] = $producto;
            $i++;
        } 
        mysqli_close($link);
        return $datos;
    }
    
    public function eliminarProducto($id_producto){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
        $query = "DELETE FROM producto WHERE id_producto =".$id_producto.";";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }
    
    public function actualizarProducto($producto){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
        $query = "UPDATE producto SET nombre_producto = '".$producto->getNombreProducto()."', id_categoria = '".$producto->getIdCategoria()."',
        stock = '".$producto->getStock()."' WHERE  id_producto = ".$producto->getIdProducto().";";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }

        public function obtenerStock($producto){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT stock FROM producto WHERE id_producto = ".$producto;
        $resultado = mysqli_query($link,$query) or die (mysqli_error());

        $row=mysqli_fetch_row($resultado);
        $stock = $row[0];   
        mysqli_close($link);
        return $stock;
    }
    
    
    public function actualizaStock($producto){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
        $query = "UPDATE producto SET stock = '".$producto->getStock()."' WHERE  id_producto = ".$producto->getIdProducto().";";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
        return 1;
        
    }
    
    public function getProducto($id_producto){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT * FROM producto WHERE id_producto=".$id_producto.";";
        $resultado = mysqli_query($link,$query) or die (mysqli_error());
        $row = mysqli_fetch_row($resultado);
        $producto = array($row[0],$row[1],$row[2],$row[3],$row[4]); 
        mysqli_close($link);
        return $producto;
        
    }
    
}


?>
