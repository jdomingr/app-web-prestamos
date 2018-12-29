<div class="container-fluid">
	<div class="navbar-header">
		<a href="javascript:void(0);" class="navbar-toggle collapsed"
			data-toggle="collapse" data-target="#navbar-collapse"
			aria-expanded="false"></a> <a href="javascript:void(0);" class="bars"></a>
		<a class="navbar-brand" href="inicio.php">HOME INVENTORY</a>
	</div>



	<div class="collapse navbar-collapse" id="navbar-collapse">
		<ul class="nav navbar-nav navbar-right">

			<!-- Notifications -->
			<li class="dropdown"><a href="javascript:void(0);"
				class="dropdown-toggle" data-toggle="dropdown" role="button">
					<?php 
                   
                    $nombre=$_SESSION["nombre"];
                    $apellido=$_SESSION["apellido"];
                    echo $nombre ." ". $apellido;
                
                    ?>
               </a>
				<ul class="dropdown-menu pull-right">
					<li><a href="javascript:void(0);"><i
							class="material-icons">person</i>Perfil</a></li>
					<li role="seperator" class="divider"></li>
					<li><a href="principal.html"><i
							class="material-icons">input</i>Cerrar Sesión</a></li>
				</ul></li>


		</ul>
	</div>
</div>