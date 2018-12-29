<?php
 session_start();
$id_usuario=$_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html>
<head>
<?php

include_once "cabecera.php";
    
include_once('../logica/principal.php');
    include_once('../to/PrestamoTO.php');
     include_once('../to/ProductoTO.php');
    $instancia=principal::getInstance();
    
    $cantidad=$instancia->getTotalProductosPrestados($id_usuario);
    
    $cantProductosBajoStock=$instancia->getTotalProductosBajoStock($id_usuario);
   $cantProductosVencidos=$instancia->getPrestamosVencidos($id_usuario);
    $datosProductosPrestados=$instancia->getDataProductosPrestados($id_usuario);
    $datosProductosBajoStock=$instancia->getDataProductosBajoStock($id_usuario);
    $datosPrestamosVencidos=$instancia->getDataPrestamosVencidos($id_usuario);
    $datosProximasDevoluciones=$instancia->getProximasDevoluciones($id_usuario);
    
    $contador=1;
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
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
		<div class="block-header">
			<h2>PRÓXIMOS EVENTOS</h2>
		</div>
        
    

		<!-- Widgets -->
		<div class="row clearfix">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" onclick="mostrarProductosPrestados();">
				<div class="info-box bg-pink hover-expand-effect">
					<div class="icon">
						<i class="material-icons">playlist_add_check</i>
					</div>
					<div class="content" >
						<div class="text">TOTAL PRODUCTOS PRESTADOS</div>
						<div class="number count-to" data-from="0" data-to="<?php echo $cantidad; ?>"
							data-speed="15" data-fresh-interval="20"></div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" onclick="mostrarProductosBajoStock();">
				<div class="info-box bg-light-green hover-expand-effect">
					<div class="icon">
						<i class="material-icons">forum</i>
					</div>
					<div class="content">
						<div class="text">PRODUCTOS CON BAJO STOCK</div>
						<div class="number count-to" data-from="0" data-to="<?php echo $cantProductosBajoStock; ?>"
							data-speed="1000" data-fresh-interval="20"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" onclick="mostrarPrestamosVencidos();">
				<div class="info-box bg-orange hover-expand-effect">
					<div class="icon">
						<i class="material-icons">event_note</i>
					</div>
					<div class="content">
						<div class="text">PRÉSTAMOS VENCIDOS</div>
						<div class="number count-to" data-from="0" data-to="<?php echo $cantProductosVencidos; ?>"
							data-speed="1000" data-fresh-interval="20"></div>
					</div>
				</div>
			</div>
		</div>
        
        
      
       <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PRÓXIMAS DEVOLUCIONES</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre Producto</th>
                                            <th>Nombre Persona</th>
                                            <th>Fecha Préstamo</th>
                                            <th>Fecha Devolución</th>
                                            <th>Cantidad</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                        $i=0;
                                        for ($i=0; $i<sizeof( $datosProximasDevoluciones); $i++){?>
                                        <tr>
                                             <td><?php echo $i+1 ?></td>
                                            <td><?php echo  $datosProximasDevoluciones[$i]->getNombreProducto();?></td>
                                           
                                            <td><?php echo  $datosProximasDevoluciones[$i]->getNombre();?></td>
                                            <td><?php $dateP = new DateTime( $datosProximasDevoluciones[$i]->getFechaPrestamo());
                                                                                              
                                                                                              echo $dateP->format('d-m-Y');?></td>
                                            <td><?php 
                                                       $dateD= new DateTime( $datosProximasDevoluciones[$i]->getFechaLimiteDevolucion());                                     
                                                                                              
                                                                                              echo $dateD->format('d-m-Y'); ?></td>
                                            <td><?php echo  $datosProximasDevoluciones[$i]->getCantidad(); ?></td>
                                            
                                        </tr>
                                       <?php 
                                                                                            
                                                                                             
                                                                                             }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
		
	</div>
        
         <div class="modal fade" id="mostrarProductosPrestados" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Productos Prestados</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre Producto</th>
                                            <th>Nombre Persona</th>
                                            <th>Fecha Préstamo</th>
                                            <th>Fecha Límite Devolución</th>
                                            <th>Cantidad</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                        for ($i=0; $i<sizeof($datosProductosPrestados); $i++){?>
                                        <tr>
                                             <td><?php echo $contador ?></td>
                                            <td><?php echo $datosProductosPrestados[$i]->getNombreProducto();?></td>
                                           
                                            <td><?php echo $datosProductosPrestados[$i]->getNombre();?></td>
                                            <td><?php $dateP = new DateTime($datosProductosPrestados[$i]->getFechaPrestamo());
                                                                                              
                                                                                              echo $dateP->format('d-m-Y');?></td>
                                            <td><?php 
                                                       $dateD= new DateTime($datosProductosPrestados[$i]->getFechaLimiteDevolucion());                                     
                                                                                              
                                                                                              echo $dateD->format('d-m-Y'); ?></td>
                                            <td><?php echo $datosProductosPrestados[$i]->getCantidad(); ?></td>
                                            
                                        </tr>
                                       <?php 
                                                                                             $contador++;
                                                                                             
                                                                                             }?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        
        
        
        
        <div class="modal fade" id="mostrarProductosBajoStock" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Productos Bajo Stock</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre Producto</th>
                                            <th>Categoría</th>
                                            <th>Stock</th>
                                                                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                        for ($i=0; $i<sizeof($datosProductosBajoStock); $i++){?>
                                        <tr>
                                             <td><?php echo $i+1 ?></td>
                                            <td><?php echo $datosProductosBajoStock[$i]->getNombreProducto();?></td>
                                           
                                            <td><?php echo $datosProductosBajoStock[$i]->getNombreCategoria();  ?></td>
                                            <td><?php echo $datosProductosBajoStock[$i]->getStock(); ?></td>
                                            
                                        </tr>
                                       <?php 
                                                                                            
                                                                                             
                                        }?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        
        
         <div class="modal fade" id="mostrarPrestamosVencidos" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Préstamos Vencidos</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre Producto</th>
                                            <th>Nombre Persona</th>
                                            <th>Fecha Préstamo</th>
                                            <th>Fecha Límite Devolución</th>
                                            <th>Cantidad</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                        for ($i=0; $i<sizeof($datosPrestamosVencidos); $i++){?>
                                        <tr>
                                             <td><?php echo $i+1 ?></td>
                                            <td><?php echo  $datosPrestamosVencidos[$i]->getNombreProducto();?></td>
                                           
                                            <td><?php echo  $datosPrestamosVencidos[$i]->getNombre();?></td>
                                            <td><?php $dateP = new DateTime( $datosPrestamosVencidos[$i]->getFechaPrestamo());
                                                                                              
                                                                                              echo $dateP->format('d-m-Y');?></td>
                                            <td><?php 
                                                       $dateD= new DateTime($datosPrestamosVencidos[$i]->getFechaLimiteDevolucion());                                     
                                                                                              
                                                                                              echo $dateD->format('d-m-Y'); ?></td>
                                            <td><?php echo  $datosPrestamosVencidos[$i]->getCantidad(); ?></td>
                                            
                                        </tr>
                                       <?php 
                                                                                             
                                                                                             
                                                                                             }?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
	</section>
   

	 <?php include_once "scripts.php"; ?>
</body>
    <script>
    
    function mostrarProductosPrestados(){
        
        //Mostrar modal
        $('#mostrarProductosPrestados').modal('show');
    }
        
        function mostrarProductosBajoStock(){
       //Mostrar modal
        $('#mostrarProductosBajoStock').modal('show');
    }
        
        function mostrarPrestamosVencidos(){
        $('#mostrarPrestamosVencidos').modal('show');
    }
        
        
        
    </script>
</html>