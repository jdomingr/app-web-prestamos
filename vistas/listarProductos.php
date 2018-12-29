<!DOCTYPE html>
<?php
include_once('../logica/principal.php');
include_once('../to/productoTO.php');
include_once('../to/categoriaTO.php');
$variable = principal::getInstance();
$arrayCategorias = $variable->obtenerCategorias();
session_start();
$id = $_SESSION['id_usuario'];
$arrayProductos = $variable->obtenerProductos($id);
?>
<html>
    <head>
        <?php
        include_once "cabecera.php";
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Productos</title>
        <link href="assets/css/bootstrap-select.css" rel="stylesheet" />
        <link href="assets/css/cssImagen.css" rel="stylesheet">
        <style type="text/css">
            .borde-dropzone{
                border: 2px dashed #47a447 !important;
                border-radius: 5px !important;
                background: white !important;
            }
        </style>

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
            <div class="container-fluid" id="lista_productos">

                <!-- Basic Examples -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Productos
                                </h2>
                                <div> <button class="btn btn-primary pull-right" onclick="abrirModalAgregarProducto();">Agregar Producto</button></div>

                                <br>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nombre</th>
                                                <th>Categoría</th>
                                                <th>Stock</th>
                                                <th>Acción</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                            $i = 0;
                                            if($arrayProductos!=null){
                                            foreach($arrayProductos as $productos){ 
                                                $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $productos->getNombreProducto(); ?></td>
                                                <td><?php echo $productos->getNombreCategoria(); ?></td>
                                                <td><?php echo $productos->getStock(); ?></td>
                                                <td><button type="button" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float">
                                                    <a onclick='abrirModalVerImagen("<?php echo $productos->getUrlImagen(); ?>");'>
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                    </button>
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <button type="button"  class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                        <a onclick='abrirModalModificarProducto(<?php echo $productos->getIdProducto();?>);'>
                                                            <i class="material-icons">mode_edit</i></a>
                                                    </button>
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <button type="button" onclick="eliminarProducto(<?php echo $productos->getIdProducto();?>);" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">delete</i>
                                                    </button></td>

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

            <div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Producto</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                <form  action="/" id="subirImagen" method="post" class="form-horizontal" enctype="multipart/form-data" >
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="nombre_prod">* Nombre Producto</label>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="nombre_prod" name="nombre_prod" class="form-control" placeholder="Ingrese el nombre del producto" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="stock_prod">* Stock</label>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" min="1" id="stock_prod" name="stock_prod" class="form-control" placeholder="Ingrese el stock">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="categoria_prod">* Categoría</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">

                                                    <select class="form-control show-tick" id="categoria_prod" name="categoria_prod">
                                                        <option value="">--Seleccione la categoría--</option>
                                                        <?php foreach($arrayCategorias as $categoria) {?>
                                                        <option value="<?php echo $categoria->getIdCategoria();?>"><?php echo $categoria->getNombre(); ?></option>
                                                        <?php }?>

                                                    </select>


                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="imagen">Imagen</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="dropzone borde-dropzone" style='cursor: pointer;' id="dropzone-previews">
                                                <div class="dz-default dz-message">
                                                    <span><h3>Subir Imagen</h3></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <br>
                                    <label class="pull-right" style="font-weight: normal; color: red">*
                                        Campos obligatorios</label>
                                </form>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="agregar_prod" class="btn btn-primary pull-rigth">Agregar</button>
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal" id="modalVerImagen" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-body">
                            <p id="showImage"></p>

                            <div class="body">

                                <img id="id_foto" style="width:100%;height:100%">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="modalModificarProducto" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modificar Producto</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Fomrulario -->

                            <div class="body">
                                <form  action="" id="formularioModificar" method="post" class="form-horizontal" enctype="multipart/form-data" >
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="nombre_producto">* Nombre Producto</label>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="nombre_producto" name="nombre_producto" class="form-control" placeholder="Ingrese el nombre del producto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="stock_producto">* Stock</label>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" min="1" id="stock_producto" name="stock_producto" class="form-control" placeholder="Ingrese el stock">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                                            <label for="categoria_producto">* Categoría</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">

                                                    <select class="form-control show-tick" id="categoria_producto" name="categoria_producto">
                                                        <option value="">--Seleccione la categoría--</option>
                                                        <?php foreach($arrayCategorias as $categoria) {?>
                                                        <option value="<?php echo $categoria->getIdCategoria();?>"><?php echo $categoria->getNombre(); ?></option>
                                                        <?php }?>

                                                    </select>


                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                  

                                    <br>
                                    <input type="hidden" id="producto_id" name="producto_id"/>
                                    <label class="pull-right" style="font-weight: normal; color: red">*
                                        Campos obligatorios</label>


                                </form>

                            </div>


                        </div>
                        <div class="modal-footer">

                            <button type="submit" id="boton_modificar" onclick="enviarDatos();" class="btn btn-primary pull-rigth">Modificar</button>

                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
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

        <!-- Jquery DataTable Plugin Js -->

    </body>

    <script type="text/javascript">

        Dropzone.autoDiscover = false;

        $('#modalAgregarProducto').on('shown.bs.modal', function (e) {

            myAwesomeDropzone = {
                maxFilessize: 4,
                maxFiles: 1,
                clickable:true,
                autoProcessQueue: false,
                addRemoveLinks: true,
                dictRemoveFile: "Remover",
                //uploadMultiple: true,
                clickable:  "#dropzone-previews",
                previewsContainer: "#dropzone-previews",
                url: "registrarProducto.php",
                paramName:"imagen",
                acceptedFiles: 'image/*',
                maxfilesexceeded: function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                init: function() {
                    dzClosure = this; 
                    document.getElementById("agregar_prod").addEventListener("click", function(e) {
                        
                        e.preventDefault();
                        e.stopPropagation();
                        dzClosure.processQueue();
                    });

                    this.on("sendingmultiple", function(data, xhr, formData) {
                        formData.append("nombre_prod", jQuery("#nombre_prod").val());
                        formData.append("stock_prod", jQuery("#stock_prod").val());
                        formData.append("categoria_prod", jQuery("#categoria_prod").val());
                        this.removeAllFiles(true);
                    });
                }

            }

            var myDropzone = new Dropzone("#subirImagen", myAwesomeDropzone); 
            myDropzone.on("complete", function(file,response) {
                myDropzone.removeAllFiles(true);
                 $('#lista_productos').load(document.URL + ' #lista_productos');
                 $('#modalAgregarProducto').modal('hide');
                 alertify.success("Producto agregado exitosamente");

            });
            
           
        });

        
        $('#modalAgregarProducto').on('hidden.bs.modal', function (event) {
             Dropzone.forElement("#subirImagen").removeAllFiles(true);
            $('#subirImagen')[0].reset();
            $('#categoria_prod').prop('selectedIndex',0);
        });
        


    </script>

    <script>

        function abrirModalAgregarProducto() {
            $('#modalAgregarProducto').modal('show');
        }

        function abrirModalModificarProducto(id) {
            $.ajax({
                type : "POST",
                url : "obtenerProducto.php",
                data: {id_producto : id},
                dataType:"json",
                success: function(data){
                    $('#nombre_producto').val(data[1]);
                    $('#stock_producto').val(data[3]);
                    $('#producto_id').val(data[0]);
                   
                    $('#modalModificarProducto').modal('show');
                }
            });

        }

        function eliminarProducto(id){
            swal({
                title: "¿Está seguro de eliminar el producto?",
                text: "Esta acción no podrá ser recuperada",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, Eliminar",
                closeOnConfirm: false
            },
                 function(){
                $.ajax({
                    type: "POST",
                    url:"eliminarProducto.php",
                    data: {id_producto:id},
                  /*  success : function(data){
                        swal({
                            title: 'Producto Eliminado!',
                            text: 'El producto ha sido eliminado exitosamente',
                            icon: 'success'
                        })
                         

                    },*/
                }); 
             swal.close();
             $('#lista_productos').load(document.URL + ' #lista_productos');
             alertify.success("Producto eliminado exitosamente!!");
            });
        }

    </script>
    <script>

        function enviarDatos(){
             $.ajax({
                    type : "POST",
                    url : "updateProductoModificar.php",
                    data: $('#formularioModificar').serialize(),
                    success: function(data){
                        $('#lista_productos').load(document.URL + ' #lista_productos');
                        $('#modalModificarProducto').modal('hide');
                         alertify.success("Producto modificado exitosamente");
                        
                         
                    }
                });
        }
       
    </script>

    <script>
        function abrirModalVerImagen(id){
            $('#id_foto').attr('src',id);
            $('#modalVerImagen').modal("show");

            /*$.ajax({
                type: "POST",
                url:"verImagen.php",
                data: {id_producto:id},
                success : function(data){
                $("#showImage").html(data);
                console.log(data.url_imagen);


            },
        }); */
        }
    </script>



</html>