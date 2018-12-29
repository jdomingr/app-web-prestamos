<?php
include('db.php');
if(isset($_POST["id_producto"]) && !empty($_POST["id_producto"])){
$query = $db->query("SELECT stock FROM producto WHERE id_producto = ".$_POST['id_producto']);
$row = mysqli_fetch_row($query);
    
 //print_r ($row[0]);
 return $row[0];
}
