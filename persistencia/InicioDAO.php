<?php
include_once('conexion.php');
class InicioDAO{
private $conexionBD;

function __construct(){
    $this->conexionBD= new conexion();
}
    function getTotalProductosPrestados($id_usuario){
         $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="select ifnull(sum(cantidad),0) as cantidad from prestamo where fecha_devolucion is null and id_usuario=".$id_usuario.";";
    
        $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
        $cant=0;
         while($row=mysqli_fetch_array($result)){
             $cant=$row['cantidad'];
         }
        return   $cant;
    }
    
    function getPrestamosFrecuentes(){
        
    }
    
    function getTotalProductosBajoStock($id_usuario){
        $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="select count(*) as cantidad from producto p join categoria c on p.id_categoria=c.id_categoria where p.stock<=5 and c.id_usuario=".$id_usuario.";";
    
        $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
        $cant=0;
         while($row=mysqli_fetch_array($result)){
             $cant=$row['cantidad'];
         }
        return   $cant;
    }
    
    function getPrestamosVencidos($id_usuario){
       $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="select count(*) as cantidad from prestamo where fecha_limite_devolucion<CURRENT_DATE and fecha_devolucion is null and id_usuario=".$id_usuario.";";
    
       $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
        $cant=0;
         while($row=mysqli_fetch_array($result)){
             $cant=$row['cantidad'];
         }
        return   $cant;
    }
    
    function getDataProductosPrestados($id_usuario){
         $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="select p.fecha_prestamo,p.fecha_limite_devolucion,p.nombre, p.cantidad,pr.nombre_producto from prestamo p join prestamo_has_producto php on p.id_prestamo=php.id_prestamo join producto pr on php.id_producto=pr.id_producto where p.fecha_devolucion is null and p.id_usuario=".$id_usuario.";";
    
        $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
       $datos=array();
         while($row=mysqli_fetch_array($result)){
            $prestamo=new PrestamoTO();
             $prestamo->setNombre($row['nombre']);
             $prestamo->setFechaPrestamo($row['fecha_prestamo']);
             $prestamo->setFechaLimiteDevolucion($row['fecha_limite_devolucion']);
             $prestamo->setCantidad($row['cantidad']);
             $prestamo->setNombreProducto($row['nombre_producto']);
             $datos[]=$prestamo;
            
         }
        return  $datos;
    }
    
    function getDataProductosBajoStock($id_usuario){
        $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="select p.nombre_producto, c.nombre as nombre_categoria, p.stock as stock_producto from producto p join categoria c on p.id_categoria=c.id_categoria where p.stock<=5 and c.id_usuario=".$id_usuario.";";
         $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
        
       $datos=array();
         while($row=mysqli_fetch_array($result)){
             $producto= new ProductoTO();
             // echo "<script>alert('".$row['stock_producto']."')</script>";
             $producto->setNombreProducto($row['nombre_producto']);
             $producto->setNombreCategoria($row['nombre_categoria']);
             $producto->setStock($row['stock_producto']);
             $datos[]=$producto;
            
         }
        return  $datos;
    }
    
    function getDataPrestamosVencidos($id_usuario){
        $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="select p.fecha_prestamo,p.fecha_limite_devolucion,p.nombre,p.cantidad,pr.nombre_producto from prestamo p join prestamo_has_producto php on p.id_prestamo=php.id_prestamo JOIN producto pr on php.id_producto=pr.id_producto where p.fecha_limite_devolucion<CURRENT_DATE and p.fecha_devolucion is null and p.id_usuario=".$id_usuario.";";
         $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
        
         $datos=array();
         while($row=mysqli_fetch_array($result)){
            $prestamo=new PrestamoTO();
             $prestamo->setNombre($row['nombre']);
             $prestamo->setFechaPrestamo($row['fecha_prestamo']);
             $prestamo->setFechaLimiteDevolucion($row['fecha_limite_devolucion']);
             $prestamo->setCantidad($row['cantidad']);
             $prestamo->setNombreProducto($row['nombre_producto']);
             $datos[]=$prestamo;
            
         }
        return  $datos;
    }
    
    function getProximasDevoluciones($id_usuario){
        $link=$this->conexionBD->getConexion(); //conexion a la bd
    
        $query="SELECT p.fecha_prestamo,p.fecha_limite_devolucion,p.nombre, p.cantidad, pr.nombre_producto from prestamo p join prestamo_has_producto php on p.id_prestamo=php.id_prestamo join producto pr on php.id_producto=pr.id_producto where p.fecha_limite_devolucion BETWEEN CURDATE() and CURDATE() + 3 and p.id_usuario=".$id_usuario.";";
         $result=mysqli_query($link,$query); //ejecuto la query
        mysqli_close($link);
        
        
         $datos=array();
         while($row=mysqli_fetch_array($result)){
            $prestamo=new PrestamoTO();
             $prestamo->setNombre($row['nombre']);
             $prestamo->setFechaPrestamo($row['fecha_prestamo']);
             $prestamo->setFechaLimiteDevolucion($row['fecha_limite_devolucion']);
             $prestamo->setCantidad($row['cantidad']);
             $prestamo->setNombreProducto($row['nombre_producto']);
             $datos[]=$prestamo;
            
         }
        return  $datos;
    }
}
