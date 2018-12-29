<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Registro Home Inventory</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="assets/css/style.css" rel="stylesheet">
        
    </head>

    <body class="signup-page"  background="images/login.jpg" >
        <div class="signup-box">
            <div class="logo">
                <a href="javascript:void(0);"><b>Home Inventory</b></a>
              
            </div>
            <div id="registro"><div class="card">
                <div class="body">
                    <form action="registroUsuario.php" method="POST">
                        <div class="msg">Registre sus Datos</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required autofocus>
                            </div>
                        </div>
                         <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="apellido" placeholder="Apellido" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" minlength="6" placeholder="Contraseña" required>
                            </div>
                        </div>
                      
                      

                        <button class="btn btn-block  bg-blue waves-effect" type="submit" onclick ="return exito();">Registrar</button>
                        <a class="btn btn-block  bg-red waves-effect" type="button" href="principal.html">Volver</a>

                        <div class="m-t-25 m-b--5 align-center">
                            <a href="#" onclick="irLogin();">¿Tienes una cuenta? Inicia Sesión</a>
                        </div>
                    </form>
                </div>
            </div></div>
            
            <div id="login" style="display:none">
            
            <div class="card">
			<div class="body">
				<form action="datos/verificaUsuario.php" method="POST">
					<div class="msg">Ingrese sus Datos para Iniciar Sesión</div>
					<div class="input-group">
						<span class="input-group-addon"> <i class="material-icons">email</i>
						</span>
						<div class="form-line">
							<input type="email" class="form-control" name="email"
								placeholder="Email" required>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon"> <i class="material-icons">lock</i>
						</span>
						<div class="form-line">
							<input type="password" class="form-control" name="password"
								placeholder="Contraseña" required >
						</div>
					</div>
					<button class="btn btn-block  bg-blue waves-effect" type="submit">Iniciar Sesión</button>
                    <a class="btn btn-block  bg-red waves-effect" type="button" href="principal.html">Volver</a>
					  <div class="m-t-25 m-b--5 align-center">
                            <a href="#" onclick="irRegistro();">¿No tienes una cuenta? Registrate</a>
                        </div>
				</form>
			</div>
		</div>
            </div>
            
        </div>

        <!-- Jquery Core Js -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="assets/plugins/node-waves/waves.js"></script>

        <!-- Validation Plugin Js -->
        <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>

        <!-- Custom Js -->
        <script src="assets/js/admin.js"></script>
        <script src="assets/js/pages/examples/sign-up.js"></script>
        <script>
         function exito(){
             alertify.success('Usuario registrado correctamente!')
            }
        </script>
        <script>
        
        function irRegistro(){
        document.getElementById('login').style.display = 'none';
        document.getElementById('registro').style.display = 'inline';
    }
        
        function irLogin (){
            document.getElementById('login').style.display = 'inline';
            document.getElementById('registro').style.display = 'none';
        }
        
        
        
         function exito(){
             alertify.success('Usuario registrado correctamente!')
            }
        
            
        </script>
    </body>

</html>
       

       
  