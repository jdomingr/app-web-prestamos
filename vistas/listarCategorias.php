
<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<?php

include_once "cabecera.php";

include_once('../to/CategoriaTO.php');
include_once('../logica/principal.php');

$jefe= principal::getInstance();
$vectorCategorias=$jefe->obtenerCategorias();
                                

?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Agregar categoría</title>
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
                                Categorías
                            </h2>
                             <div> <button class="btn btn-primary pull-right" onclick="abrirModalAgregarCategoria();">Agregar Categoría</button></div>
                             <br>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre</th>
                                            <th>Acción</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador=0; 
                                        
                                        if($vectorCategorias!=null){
										foreach ($vectorCategorias as $cat){
                                             
                                             $contador++; 
                                        ?>
                                            
											
											<tr>


												<td><?php echo $contador;?></td>
												<td> <?php echo $cat->getNombre();?></td>
											<td><button type="button" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                            <a  onclick="abrirModalEditarCategoria(<?php echo $cat->getIdCategoria();?>)"
                                               ><i class="material-icons">mode_edit</i></a></button>
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                <a onclick="eliminarCategoria(<?php echo $cat->getIdCategoria();?>)"><i class="material-icons">delete</i></a></button>
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
    
    
    <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Categoría</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                 <form action="registroCategoria.php" method="POST">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="email_address_2">* Nombre de la Categoría</label>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input name ="nombre" type="text" id="nombre_categoria" class="form-control" placeholder="Ingrese el nombre de la categoría" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                               
                                    <label class="pull-right" style="font-weight: normal; color: red">*
								Campos obligatorios</label>
                                     <br>
                                      <div class="modal-footer">

                            <button  class="btn btn-primary pull-rigth" type="submit">Agregar</button>
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                            </div>


                        </div>
                       
                    </div>
                </div>
            </div>
        
        
        <div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Editar Categoría</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                 <form action="guardarCategoriaEditada.php" method="POST">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="email_address_2">* Nombre de la Categoría</label>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input name ="nombreCategoria" type="text" id="nombreCategoria" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                               
                                    <label class="pull-right" style="font-weight: normal; color: red">*
								Campos obligatorios</label>
                                     <br>
                                     <input type="hidden" id="idcategoria" class="form-control" name="id_categoria" >
                                      <div class="modal-footer">

                            <button  class="btn btn-primary pull-rigth" type="submit">Guardar</button>
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
    
        alertify.success('Categoria Agregada Correctamente');
    
    </script>
    
    <?php
    
    }
    
    ?>
    
   <?php 
    $exitoEditar=intval($_GET["exitoEditar"]);
    if($exitoEditar==1){
        
    
    ?>
    <script>
    
        alertify.error('Categoria eliminada Correctamente');
    
    </script>
    
    <?php
    
    }
    
    ?>
    
      <?php 
    $editar=intval($_GET["edit"]);
    if($editar==1){
        
    
    ?>
    <script>
    
        alertify.success('Categoria Modificada Correctamente');
    
    </script>
    
    <?php
    
    }
    
    ?>

   
</body>


<script>
    function abrirModalAgregarCategoria() {
        $('#nombre_categoria').val("");
            $('#modalAgregarCategoria').modal('show');
    }
        
        function agregarDatosCategoria(){
     alertify.success('Categoría agregada correctamente!');
    $('#modalAgregarCategoria').modal('hide');
    }
    
    
   
   
    
     function eliminarCategoria(idCategoria){
      

			swal({
				  title: "¿Está seguro de eliminar la categoria?",
				  text: "Esta acción no podrá ser recuperada",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  cancelButtonText: "Cancelar",
				  confirmButtonText: "Si, Eliminar",
				  closeOnConfirm: false
				},
				function(){
						  
				  //Ajax para eliminar
				  $.ajax({
                      url : 'eliminarCategoria.php?idCategoria='+idCategoria,
						type : 'get',
						
						success : function(data) {
							if(data!=null){
								swal.close();
                            //alertify.success("Categoria eliminado correctamente");
                                  window.location.href = "listarCategorias.php?exitoEditar=1&exito=0&edit=0";
                                } 
							else {
								alertify.error("Error al eliminar la categoria");
							
						}	
                       },
						error : function(jqXHR, errorThrown) {
							alert.error("Error al eliminar categoria");
					}
				});
			})
     }
    
    
    
    
    
    function abrirModalEditarCategoria(idcategoria){
    $('#modalEditarCategoria').modal('show');
                    $.ajax({
                     type:'POST',
                     url:'modificarCategoria.php',
                     dataType : 'json',    
                     data:{id_categoria:idcategoria},
                     success:function(data){
                     //console.log(data);
                       $('#nombreCategoria').val(data['nombre_categoria']);
                         $('#idcategoria').val(data['id_categoria']); 
                      
				   }
             });
        
                    
}   
    </script>
   

    
</html>