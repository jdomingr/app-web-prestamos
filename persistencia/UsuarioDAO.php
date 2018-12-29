<?php
include_once('conexion.php');
class UsuarioDAO{
private $conexionBD;



function __construct(){
    $this->conexionBD= new conexion();
}

public function insertarUsuario($usuario){
    
    $link=$this->conexionBD->getConexion(); //conexion a la bd
    
    $query="INSERT INTO usuario (nombre,apellido,correo,clave) VALUES('".$usuario->getNombre()."','".$usuario->getApellido()."','".$usuario->getCorreo()."','".$usuario->getClave()."')";
    
    mysqli_query($link,$query) or die(mysqli_error()); //ejecuto la query
    mysqli_close($link);
}
    
    public function verificarUsuario($usuario){
         $link=$this->conexionBD->getConexion(); //conexion a la bd
        
        $query="select * from usuario where correo='".$usuario->getCorreo()."' and clave='".$usuario->getClave()."';";
        $resultado=mysqli_query($link,$query);
         $numero=mysqli_num_rows($resultado);  
        if($numero>=1){
            $u = mysqli_fetch_row($resultado);
            session_start();
            $_SESSION['id_usuario']=$u[0];
            $_SESSION['nombre']=$u[1];
            $_SESSION['apellido']=$u[2];
            $_SESSION['correo']=$u[3];
            return true;
        }else{
            return false;
        }
        
          mysqli_close($link);
    }
}

?>
