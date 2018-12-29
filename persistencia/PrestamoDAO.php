<?php
include_once('conexion.php');
class PrestamoDAO{
private $conexionBD;

function __construct(){
    $this->conexionBD= new conexion();
}
    
    public function guardarPrestamo($prestamo){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
        //Consulta
        $query = "INSERT INTO prestamo (fecha_prestamo,  nombre, cantidad, id_usuario,fecha_limite_devolucion)
                  VALUES(NOW(),  '".$prestamo->getNombre()."','".$prestamo->getCantidad()."','".$prestamo->getIdUsuario()."','".$prestamo->getFechaLimiteDevolucion()."')";
          
        //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        
        $query2 = "select last_insert_id() from prestamo;";
        $resultado = mysqli_query($link,$query2) or die(mysqli_error());
        
        $row=mysqli_fetch_row($resultado);
        $idprestamo = $row[0];
        
        mysqli_close($link);
        
       return $idprestamo;
    }
    
     public function obtenertodoslosprestamos($id){
        $datos=null;
        $link = $this->conexionBD->getConexion();
        $query = "SELECT * FROM prestamo WHERE id_usuario = ".$id." AND fecha_devolucion is null";
        $resultado = mysqli_query($link,$query) or die (mysqli_error());
        $i = 0;
        while($row=mysqli_fetch_array($resultado)){
            $prestamo = new PrestamoTO();
            $prestamo->setIdPrestamo($row['id_prestamo']);
            $prestamo->setFechaPrestamo($row['fecha_prestamo']);
            $prestamo->setNombre($row['nombre']);
            $prestamo->setCantidad($row['cantidad']);
            $prestamo->setfechaLimiteDevolucion($row['fecha_limite_devolucion']);
            $datos[$i] = $prestamo;
            $i++;
        } 
        mysqli_close($link);
        return $datos;
    }
    
     public function deletePrestamo($prestamo){
         
         $fecha_devolucion = date('Y-m-d'); 
        //Conexion BD
        $link = $this->conexionBD->getConexion();
         $query = "UPDATE prestamo SET fecha_devolucion = '".$fecha_devolucion."' WHERE  id_prestamo = ".$prestamo->getIdPrestamo().";";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }
 
    
    public function obtenerunprestamo($id){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT cantidad FROM prestamo WHERE id_prestamo = ".$id;
        $resultado = mysqli_query($link,$query) or die (mysqli_error());

        $row=mysqli_fetch_row($resultado);
        $cant = $row[0];   
        mysqli_close($link);
        return $cant;
    }
    
    public function getunprestamo($prestamo){
        $link = $this->conexionBD->getConexion();
        $query = "SELECT * FROM prestamo WHERE id_prestamo = '".$prestamo->getIdPrestamo()."';";
        $resultado = mysqli_query($link,$query) or die (mysqli_error());

        $row=mysqli_fetch_row($resultado);
       
        
        mysqli_close($link);
        return $row;
        
    }
    
    
     public function actualizaprestamo($prestamo){
        //Conexion BD
        $link = $this->conexionBD->getConexion();
       
        $query = "UPDATE prestamo SET nombre = '".$prestamo->getNombre()."', cantidad = '".$prestamo->getCantidad()."',
        fecha_limite_devolucion = '".$prestamo->getFechaLimiteDevolucion()."' WHERE  id_prestamo = '".$prestamo->getIdPrestamo()."';";
         //Se ejecuta la consulta          
        mysqli_query($link,$query) or die(mysqli_error());
        //se cierra la conexion
        mysqli_close($link);
        
    }
                                          
                                          
    }
                                          