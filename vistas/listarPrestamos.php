<?php session_start (); ?>
<!DOCTYPE html>
<html>
<head>
<?php

include_once "cabecera.php";
include_once('../to/PrestamoTO.php');
include_once('../logica/principal.php');    

$fecha = date('Y-m-d'); 
/**    
$nuevafecha = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
echo $nuevafecha;*/
    
$idU = $_SESSION["id_usuario"];


$jefe= principal::getInstance();
$vectorPrestamos=$jefe->obtenerPrestamos($idU);    

?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Préstamos</title>
<link href="assets/css/bootstrap-select.css" rel="stylesheet" />
    
<script src="assets/js/jquery.min.js"></script>  

    
<script>
    
function cargarProductos(){
        var categoriaID = $('#categoria').val();
         if(categoriaID>0){
             $.ajax({
             type:'POST',
             url:'ajaxData.php',
             dataType : 'json',
             data:{id_categoria:categoriaID},
             success:function(data){
             console.log(data);
             $('#producto').empty();      
             $("#producto").append(
						'<option value="-1">Seleccione un Producto</option>');
				    for (var i = 0; i < data.length; i++) {
					$("#producto").append(
							'<option value='+data[i].id_producto+'>'
									+ data[i].nombre +'</option>');

				}
                 $('#producto').selectpicker('refresh');
             }
             });
             }else{
                  $('#producto').html('<option value="">Selecciona un Producto</option>');
             }
}
    
    function cargarProductos2(){
        var categoriaID = $('#categorias').val();
         if(categoriaID>0){
             $.ajax({
             type:'POST',
             url:'ajaxData.php',
             dataType : 'json',
             data:{id_categoria:categoriaID},
             success:function(data){
             console.log(data);
             $('#productos').empty();      
             $("#productos").append(
						'<option value="-1">Seleccione un Producto</option>');
				    for (var i = 0; i < data.length; i++) {
					$("#productos").append(
							'<option value='+data[i].id_producto+'>'
									+ data[i].nombre +'</option>');

				}
                 $('#productos').selectpicker('refresh');
             }
             });
             }else{
                  $('#productos').html('<option value="">Selecciona un Producto</option>');
             }
}
        
</script>
</head>
<body class="theme-red">

	<!-- Page Loader -->
	<div class="page-loader-wrapper">
		<div class="loader">
			<div class="preloader">
				<div class="spinner-layer pl-cyan">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
			<p>Espere Por Favor ...</p>
		</div>
	</div>

	<!-- #END# Page Loader -->
	<!-- Overlay For Sidebars -->
	<div class="overlay"></div>
	<!-- #END# Overlay For Sidebars -->

	<nav class="navbar"> <?php include_once "barraSuperior.php"; ?>
	</nav>

	<section> <!-- Left Sidebar --> <aside id="leftsidebar"
		class="sidebar">  <?php include_once "barraLateral.php"; ?>

	</aside> </section>

	<section class="content">
	<div class="container-fluid">
		 
             <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Préstamos
                            </h2>
                            <div> <button class="btn btn-primary pull-right" onclick="abrirModalAgregarPrestamo();">Agregar Préstamo</button></div>
                           
                            <br>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre Persona</th>
                                            <th>Nombre Producto</th>
                                            <th>Cantidad</th>
                                            <th>Fecha Préstamo</th>
                                            <th>Fecha Devolución Límite</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php
                                                $i = 0;
                                        
                                        if($vectorPrestamos!=null){
                                            foreach($vectorPrestamos as $prestamo){ 
                                                $i++;
                                            ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $prestamo->getNombre();?></td>
                                            <?php
                                                include_once('../logica/principal.php');
                                                $con= principal::getInstance();
                                                $nombreproducto=$con->obtenerNombreProducto($prestamo->getIdPrestamo());
                                                ?>
                                            <td><?php echo $nombreproducto;?></td>
                                            <td><?php echo $prestamo->getCantidad();?></td>
                                            <td><?php echo $prestamo->getFechaPrestamo();?></td>
                                            <td><?php echo $prestamo->getFechaLimiteDevolucion();?></td>
                                            <td><button  title="Modificar Préstamo" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" onclick="abrirModalModificarPrestamo(<?php echo $prestamo->getIdPrestamo();?>);">
                                            <i class="material-icons">mode_edit</i></button>
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                            <button type="button" title="Realizar Devolución" class="btn bg-green btn-circle waves-effect waves-circle waves-float" onclick="eliminarPrestamo(<?php echo $prestamo->getIdPrestamo();?>)"><i class="material-icons">cached</i></button>
                                            </td>
                                            
                                        </tr>
                                       <?php
                                               
                                            }
                                        }else{
                                            echo '<tr><td colspan="7" class="text-center">No hay Datos</td></tr>';
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
            
            <div class="modal fade" id="modalAgregarPrestamo" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Préstamo</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->
                            
                            <div class="body">
                            <form class="form-horizontal" action="ingresoPrestamo.php" method="post"> 
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email_address_2">* Nombre </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email_address_2" class="form-control" placeholder="Ingrese nombre de la persona a realizar préstamo" name="nombre" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                                <?php 
                                   include_once('../to/CategoriaTO.php');
                                   include_once('../logica/principal.php');
                                   $jefe= principal::getInstance();
                                   $vectorCategorias=$jefe->obtenerCategorias();
                                ?>
                                
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="email_address_2">* Categoría</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">

                                                    <select class="form-control show-tick" id="categoria" name="categoria" onchange="cargarProductos();">
                                                        <option value="">Seleccione la categoría</option>
                                                        <?php foreach ($vectorCategorias as $cat):?>
                                                        <option  value="<?php echo $cat->getIdCategoria();?>"><?php echo $cat->getNombre();?></option>
                                                    <?php endforeach ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                
                                <br>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="email_address_2">* Producto</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">

                                                    <select id ="producto" class="form-control show-tick"  name="producto" >
                                                       <option value="">Primero Seleccione una categoría</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                   <br>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email_address_2">* Cantidad </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="cantidad" type="number" class="form-control" placeholder="Ingrese la cantidad de productos" min="1" name="cantidad" required >
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!--<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email_address_2">* Fecha préstamo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input  type="date" class="datepicker form-control" name="fprestamo" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>-->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">


                                        <label for="email_address_2">*Fecha Límite de Devolución</label>

                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="flimitedev" min="<?=$fecha ?>" required> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                                <label class="pull-right" style="font-weight: normal; color: red">*
								Campos obligatorios</label>
                                
                               
                                
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-rigth">Agregar</button>
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            </div>
                            </form>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <!--------------------------------comienzo modal modificar------------------------------------------------------->
          <div class="modal fade" id="modalModificarPrestamo" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modificar Préstamo</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->
                            
                            <div class="body">
                            <form class="form-horizontal" action="actualizarPrestamo.php" method="post"> 
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email_address_2">* Nombre </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nombreP" class="form-control" placeholder="Ingrese nombre de la persona a realizar préstamo" name="nombre" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                                <?php 
                                   include_once('../to/CategoriaTO.php');
                                   include_once('../logica/principal.php');
                                   $jefe= principal::getInstance();
                                   $vectorCategorias=$jefe->obtenerCategorias();
                                ?>
                                
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="email_address_2">* Categoría</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">

                                                    <select class="form-control show-tick" id="categorias" name="categoria" onchange="cargarProductos2();">
                                                        <?php foreach ($vectorCategorias as $cat):?>
                                                        <option  value="<?php echo $cat->getIdCategoria();?>"><?php echo $cat->getNombre();?></option>
                                                         <?php endforeach ?>
                                                        
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                
                                <br>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="email_address_2">* Producto</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">

                                                    <select id ="productos" class="form-control show-tick"  name="producto" >
                                                       
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                   <br>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email_address_2">* Cantidad </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="cantidadP" type="number" class="form-control" placeholder="Ingrese la cantidad de productos" min="1" name="cantidad" required >
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!--<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                        <label for="email_address_2">* Fecha préstamo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input  type="date" class="datepicker form-control" name="fprestamo" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>-->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">


                                        <label for="email_address_2">*Fecha Límite de Devolución</label>

                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" id="fechaP" class="form-control" name="flimitedev" min="<?=$fecha ?>" required> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="idprestamo" class="form-control" name="id_prestamo" > 
                                <br>
                                
                                <label class="pull-right" style="font-weight: normal; color: red">*
								Campos obligatorios</label>
                                
                               
                                
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-rigth">Modificar</button>
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            </div>
                            </form>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
	</section>
     
	 <?php include_once "scripts.php"; ?>
       <!-- Jquery DataTable Plugin Js -->
    <script src="assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="assets/js/pages/tables/jquery-datatable.js"></script>
    
    <?php 
    $exito=intval($_GET["exito"]);
    if($exito==1){
        
    
    ?>
    <script>
    
        alertify.success('Préstamo Agregado Correctamente');
    
    </script>
    
    <?php
    
    }
    
    ?>
    
     <?php 
    $res=intval($_GET["error"]);
    $stock = intval ($_GET["stock"]);
    if($res==1){


    ?>
    <script>

        alertify.error("Sólo quedan "+<?= $stock; ?>+" productos disponibles para prestar");
        $('#modalAgregarPrestamo').modal('show');

    </script>

    <?php

    }

    ?>
    
    <?php 
    $res=intval($_GET["elim"]);
    if($res==1){


    ?>
    <script>

        alertify.success("Devolución realizada correctamente");

    </script>

    <?php

    }

    ?>
    
       <?php 
    $res=intval($_GET["mod"]);
    if($res==1){


    ?>
    <script>

        alertify.success("Modificación exitosa");

    </script>

    <?php

    }

    ?>

   
</body>


<script>

function abrirModalAgregarPrestamo(){
    $('#modalAgregarPrestamo').modal('show');
}
    function abrirModalModificarPrestamo(idprestamo){
    $('#modalModificarPrestamo').modal('show');
                    $.ajax({
                     type:'POST',
                     url:'modificarPrestamo.php',
                     dataType : 'json',    
                     data:{id_prestamo:idprestamo},
                     success:function(data){
                     //console.log(data);
                       $('#idprestamo').val(data['id_prestamo']);    
                       $('#nombreP').val(data['nombre']);
                       $('#cantidadP').val(data['cantidad']);
                       $('#fechaP').val(data['fecha_limite_devolucion']);
                       $('#categorias').append(
                       '<option value="'+data['id_categoria']+'">'+data['nombreCategoria']+'</option>');
                       $('#categorias').selectpicker('refresh');
                       $('#productos').append(
                       '<option value="'+data['id_producto']+'">'+data['nombreProducto']+'</option>');   
                    $('#productos').selectpicker('refresh');     
				   }
             });
        
                    
}   
</script>    
    
    
<script>    
    function eliminarPrestamo(idprestamo){
    swal({
				  title: "¿Está seguro de realizar devolución?",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  cancelButtonText: "Cancelar",
				  confirmButtonText: "Aceptar",
				  closeOnConfirm: false
				},
				function(){
                     $.ajax({
                     type:'POST',
                     url:'eliminarPrestamo.php',
                     data:{id_prestamo:idprestamo},
                     
            });
        
        swal.close();
        window.location.href = "listarPrestamos.php?elim=1&exito=0&error=0&stock=0&mod=0";
    });

       

    }

    
</script>
    
    
    


</html>