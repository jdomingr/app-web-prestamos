<?php
include_once('../to/ProductoTO.php');
include_once('../logica/principal.php');

$producto = new ProductoTO();
//carpeta donde almacenaremos las imagenes que subiremos
$output_dir = "fotos/";

$nombre = $_POST['nombre_prod'];
$stock = $_POST['stock_prod']; 
$categoria = $_POST['categoria_prod'];


//$dir = dirname(__FILE__);
if(isset($_FILES["imagen"])){
    //myfile es el valor fileName que establecimos en el JS



    
    $error =$_FILES["imagen"]["error"];
    //You need to handle  both cases
    //If Any browser does not support serializing of multiple files using FormData() 
    if(!is_array($_FILES["imagen"]["name"])) //single file
    {
        //Cuando subimos un solo archivo
        /*
		Basicamente movemos el archio subidor a la carpeta donde se guardara
		*/
        $fileName = $_FILES["imagen"]["name"];
        
        move_uploaded_file($_FILES["imagen"]["tmp_name"],$output_dir.$fileName);
        $ruta = $output_dir.$fileName;
      
    }
}



$producto->setNombreProducto($nombre);
$producto->setStock($stock);
$producto->setIdCategoria($categoria);
$producto->setUrlImagen($ruta);
$controlador= principal::getInstance();

$controlador->guardarProducto($producto);

?>