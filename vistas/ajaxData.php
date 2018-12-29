<?php
include('db.php');
if(isset($_POST["id_categoria"]) && !empty($_POST["id_categoria"])){
$query = $db->query("SELECT * FROM producto WHERE id_categoria = ".$_POST['id_categoria']);
$rowCount = $query->num_rows;

 if($rowCount > 0){
 $datos=array();
 while($row = mysqli_fetch_array($query)){
     
     $array = array("id_producto" => $row['id_producto'],"nombre"=>$row['nombre_producto']);
     $datos[]=$array;
 }
     
     echo json_encode($datos);
 
    }
}
