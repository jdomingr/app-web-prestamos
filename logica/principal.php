<?php

include_once('../persistencia/UsuarioDAO.php');
include_once('../persistencia/CategoriaDAO.php');
include_once('../persistencia/InicioDAO.php');
include_once('../persistencia/PrestamoDAO.php');
include_once('../persistencia/ProductoDAO.php');
include_once('../persistencia/Prestamo_has_ProductoDAO.php');


class principal{
    private static $instancia;

    private  $persistenciaUsuario;
    private  $persistenciaCategoria;
    private $persistenciaInicio;
    private $persistenciaPrestamo;
    private $persistenciaProducto;
    private $persistenciaPrestamo_has_Producto;


    private function __construct(){
        $this->persistenciaUsuario=new UsuarioDAO();
        $this->persistenciaCategoria=new CategoriaDAO();
        $this->persistenciaInicio=new InicioDAO();
        $this->persistenciaPrestamo=new PrestamoDAO();
        $this->persistenciaProducto=new ProductoDAO();
        $this->persistenciaPrestamo_has_Producto=new Prestamo_has_ProductoDAO();


    }

    public function getInstance(){

        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        } 
        return self::$instancia;
    }


    public function guardarUsuario($usuario){
        $this->persistenciaUsuario->insertarUsuario($usuario);
    }


  
public function guardarCategoria($categoria){
   $resultado=$this->persistenciaCategoria->insertarCategoria($categoria);
    
       header("Location: listarCategorias.php?exito=1&exitoEditar=0&edit=0"); 
    
     
    }

    public function verificarUsuario($usuario){
        $valor=$this->persistenciaUsuario->verificarUsuario($usuario);


        if($valor==true){

            header("Location:inicio.php");
        }else{

            header("Location:login.php?mal=1");


        }
    }


    public function obtenerCategorias(){

        $vectorData=$this->persistenciaCategoria->getCategorias();
        if(count($vectorData)==0)
            return null;
        return $vectorData;
    }

    function getTotalProductosPrestados($id_usuario){
        $cantidad=$this->persistenciaInicio->getTotalProductosPrestados($id_usuario);
        return $cantidad;
    }

    function getTotalProductosBajoStock($id_usuario){
        $cantidad=$this->persistenciaInicio->getTotalProductosBajoStock($id_usuario);
        return $cantidad;
    }

    function getPrestamosVencidos($id_usuario){
        $cantidad=$this->persistenciaInicio->getPrestamosVencidos($id_usuario);
        return $cantidad;
    }

    function getDataProductosPrestados($id_usuario){
        $data=$this->persistenciaInicio->getDataProductosPrestados($id_usuario);
        return $data;
    }

    public function ingresarPrestamo($prestamo){
        $idprestamo=$this->persistenciaPrestamo->guardarPrestamo($prestamo);

        return $idprestamo;

    }

    public function consultaStock($producto){

        $stock = $this->persistenciaProducto->obtenerStock($producto);

        return $stock;
    }

    public function ingresarPrestamoProducto($prestamo_producto){
        $this->persistenciaPrestamo_has_Producto->guardarPrestamo_Producto($prestamo_producto);


    }

    public function actualizarStock($producto){

        $resultado = $this->persistenciaProducto->actualizaStock($producto);

        header("Location:listarPrestamos.php?exito=1&error=0&stock=0&elim=0&mod=0");


    }

    public function obtenerPrestamos($id){
        $vectorData=$this->persistenciaPrestamo->obtenertodoslosprestamos($id);
        if(count($vectorData)==0)
            return null;
        return $vectorData;
    }

    public function obtenerNombreProducto($id){
        $Data=$this->persistenciaPrestamo_has_Producto->obtenernombreproducto($id);
        return $Data;
    }

    public function eliminarPrestamo($prestamo){

        $this->persistenciaPrestamo->deletePrestamo($prestamo);
        header("Location: listarPrestamos.php?elim=1&exito=0&error=0&stock=0&mod=0");
    }

    public function obtenerPrestamo($id){

        $cantidad = $this->persistenciaPrestamo->obtenerunprestamo($id);
        return $cantidad;
    }


    public function guardarProducto($producto){
        $this->persistenciaProducto->insertarProducto($producto);
    }


    public function getStock($id){

        $producto = $this->persistenciaPrestamo_has_Producto->getstock($id);
        return $producto;
    }

    public function actualizarStock2($producto){

        $resultado = $this->persistenciaProducto->actualizaStock($producto);

    }

    
    function getDataProductosBajoStock($id_usuario){
         $data=$this->persistenciaInicio->getDataProductosBajoStock($id_usuario);
        return $data;
    }
    
    function getDataPrestamosVencidos($id_usuario){
         $data=$this->persistenciaInicio->getDataPrestamosVencidos($id_usuario);
        return $data;
    }
    
    function getProximasDevoluciones($id_usuario){
         $data=$this->persistenciaInicio->getProximasDevoluciones($id_usuario);
        return $data;
    }
    

    public function obtenerUnPrestamo($prestamo){
        $unprestamo  = $this->persistenciaPrestamo->getunprestamo($prestamo);
        return $unprestamo;
    }
    
    public function obtenerelproducto ($prestamo){
        $producto = $this->persistenciaPrestamo_has_Producto->getelproducto($prestamo);
        return $producto;
    }
    
    public function obtenerlacategoria($id){
        
        $categoria = $this->persistenciaCategoria->getlacategoria($id);
        return $categoria;
        
    }
    

    public function eliminarCatego($categoria){

        $this->persistenciaCategoria->borrarCategoria($categoria);
        
          
    }
    
     public function categoriaAEditar($categoria){

        $nombre=$this->persistenciaCategoria->obtenerCategoria($categoria);
        return $nombre;
        
          
    }
    
    

    
    public function actualizarPrest($prestamo){
        $this->persistenciaPrestamo->actualizaprestamo($prestamo);
        
    }
    
    public function actualizarTablaRelacion($idprestamo,$idproducto){
     $this->persistenciaPrestamo_has_Producto->actualizarTR($idprestamo,$idproducto);   
    }


    public function obtenerProductos($id_usuario){
        $datos = $this->persistenciaProducto->getProductos($id_usuario);
        return $datos;
    }

    public function deleteProducto($id_producto){
        $this->persistenciaProducto->eliminarProducto($id_producto);
    }

    public function updateProducto($producto){
        $this->persistenciaProducto->actualizarProducto($producto);
    }
    
    public function obtenerDatosProducto($id_producto){
        $datos = $this->persistenciaProducto->getProducto($id_producto);
        return $datos;
    }
    
    
    public function obtlacategoria($categoria){
        $categoria = $this->persistenciaCategoria->obCategoria($categoria);
        return $categoria;
    }

public function actualizarCategoria($categoria){
        $this->persistenciaCategoria->actualizarCat($categoria);
        
    }



}

?>
