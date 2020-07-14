<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["n_usuario"])) {
	header("location: login.php");
}
else
{
	require 'header.php';

	if ($_SESSION['n_usuario']=='admin')
	{
		?>
		<!--ENCABEZADO DEL CUERPO DE LA PAGINA-->
		<strong class="nav-link text-right"><?php echo $_SESSION['n_usuario']; ?></strong>
		<div class="card-header" id="menuBotones">
			<nav class="navbar navbar-expand-sm bg-light justify-content-center">
				<ul class="navbar-nav">
					<li class="nav-item">
						<button class="btn btn-light">
							<a class="nav-link" href="modulo_administrador.php">INICIO</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light" id="btnusuarios">
							<a class="nav-link" href="#" onclick="mostrarSeccion1(true)">USUARIOS</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light" id="btndatper">
							<a class="nav-link" href="#" onclick="mostrarSeccion2(true)">DATOS PERSONALES</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light" id="btndatneg">
							<a class="nav-link" href="#" onclick="mostrarSeccion3(true)">DATOS DEL NEGOCIO</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light" id="btngiros">
							<a class="nav-link" href="#" onclick="mostrarSeccion4(true)">GIROS</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light" id="btnsalir">
							<a class="nav-link" href="../ajax/usuarios.php?op=salir">CERRAR SESIÓN</a>
						</button>
					</li>
				</ul>
			</nav>
		</div>
		<!--Caroucel-->
		<div class="card text-center" id="divCarousel">
			
		</div><br /><br />
		<!--Fin Carousel-->
		<!--Modal de formulario para Editar Usuarios-->
		<div class="modal fade" id="ventanaEditUsuario" tabindex="-11" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true" align="center" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!--Inicio de encabezado-->
					<div class="modal-header justify-content-center" style="background-color: #424874;">
						<h5 id="tituloVentana" style="color: #ffffff">Editar/Agregar Usuario</h5>
					</div>
					<!--Fin inicio de encabezado-->
					<!--Cuerpo de encabezado-->
					<div class="modal-body justify-content-center" id="formularioUsuarios" style="background-color: #a6b1e1;">
						<div>
							<form class="form-inline" id="formEditUsuario" method="post">
								<div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<label class="control-label col-md-4">Nombre Usuario</label>
									<input type="hidden" name="idusuario" id="idusuario">
									<input class="form-control col-md-8" type="text" id="n_usuario" name="n_usuario" maxlength="15" required/><br/><br/><br/>
								</div>
								<div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<label class="control-label col-md-4" >Contraseña</label>
									<input class="form-control col-md-8" type="text" id="c_usuario" name="c_usuario" maxlength="15" required/><br/><br/><br/>
								</div>
								<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 mx-auto">
									<button class="btn btn-primary col-5" type="submit" id="btnGuardarUsuarios" style="margin-right: 15px" >Guardar</button>
									<button class="btn btn-danger col-5" type="button" data-dismiss="modal">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
					<!--Fin cuerpo de encabezado-->
					<!--Inicio pie de encabezado-->
					<div class="modal-footer"> </div>
					<!--Fin pie de encabezado-->
				</div>
			</div>
		</div>
		<!--Fin Modal de formulario para Editar Usuarios / Agregar Usuarios-->
		<!--Modal de formulario para Editar Usuarios-->
		<div class="modal fade" id="ventanaEditGiro" tabindex="-11" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true" align="center" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!--Inicio de encabezado-->
					<div class="modal-header justify-content-center" style="background-color: #424874;">
						<h5 id="tituloVentana" style="color: #ffffff">Editar/Agregar Giro</h5>
					</div>
					<!--Fin inicio de encabezado-->
					<!--Cuerpo de encabezado-->
					<div class="modal-body justify-content-center" id="formularioGiro" style="background-color: #a6b1e1;">
						<div>
							<form class="form-inline" id="formEditGiro" method="post">
								<div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<label class="control-label col-md-4">Nombre del Giro:</label>
									<input type="hidden" name="idgiro" id="idgiro">
									<input class="form-control col-md-8" type="text" id="n_giro" name="n_giro" maxlength="200" required/>
								</div><br/><br/><br/>
								<div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<label class="control-label col-md-4" >Descripción:</label>
									<textarea class="form-control col-md-8" type="text" id="d_giro" name="d_giro" maxlength="250" rows="4" cols="50" required></textarea>
								</div>
									<div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12"><br/><br/><br/>
										<label class="justify-content-end col-md-4">Tipo de giro:</label>
										<select class="form-control col-md-8" name="c_giro" id="c_giro" required>
											<option value="Productos">Productos</option>
											<option value="Servicioss">Servicios</option>
										</select>
									</div>
									<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 mx-auto" style="margin-top: 20px;">
										<button class="btn btn-primary col-5" type="submit" id="btnGuardarGiro" style="margin-right: 15px" >Guardar</button>
										<button class="btn btn-danger col-5" type="button" data-dismiss="modal">Cancelar</button>
									</div>
								</form>
							</div>
						</div>
						<!--Fin cuerpo de encabezado-->
						<!--Inicio pie de encabezado-->
						<div class="modal-footer"> </div>
						<!--Fin pie de encabezado-->
					</div>
				</div>
			</div>
			<!--Fin Modal de formulario para Editar Usuarios / Agregar Usuarios-->
			<div class="" style="max-width: 80%; margin: 0 auto; float: none; margin-bottom: 3%; margin-top: 3%; padding-bottom: 2%;">
				<!-- Main content -->
				<div class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box">
								<!--Sección de Usuario-->
								<div id="seccion1" class="panel-body">
									<h4 class="card-header text-left">Usuarios</h4>
									<div class="row" style="padding-top: 2%; padding-right: 1%;">
										<div class="col-lg-12 justify-content-end text-right">
											<button class="btn btn-success text-md-right" data-toggle="modal" data-target="#ventanaEditUsuario" id="btnagregarUsuario">
												<a class="nav-link" href="#" onclick="mostrarformUsuarios(true)">Agregar</a>
											</button><br/><br/>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<table id="tbllistadoUsuarios" class="table table-striped table-bordered table-condensed table-hover table table-responsive-md text-center" style="width: 100%;">
												<thead>
													<th>Id Usuario</th>
													<th>Número usuario</th>
													<th>Contraseña</th>
													<th>Editar</th>
													<th>Eliminar</th>
													<th>Activar / Desactivar</th>
													<th>Estado</th>
												</thead>
												<tbody>
												</tbody>
											</table>

										</div>
									</div>
								</div>
								<!--Fin Sección de Usuario-->
								<!--Sección de Datos Personales-->
								<div id="seccion2" class="panel-body">
									<h5 class="card-header text-left">Datos Personales</h5>
									<div class="row" style="padding-top: 2%; padding-right: 1%;">
									</div>
									<div class="row justify-content-center">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<table id="tbllistadoDatosPersonales" class="table table-striped table-bordered table-condensed table-hover table table-responsive-md text-center" style="width: 100%;">
												<thead>
													<th>Id personal</th>
													<th>Numero</th>
													<th>A. Paterno</th>
													<th>A. Materno</th>
													<th>RFC</th>
													<th>Telefono</th>
													<th>Correo</th>
													<th>Editar</th>
													<th>Eliminar</th>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--Fin Sección de Datos Personales-->
								<!--Sección Datos del negocio-->
								<div id="seccion3" class="panel-body">
									<h5 class="card-header text-left">Datos del Negocio</h5>
									<div class="row" style="padding-top: 2%; padding-right: 1%;">
									</div>
									<div class="row justify-content-center">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<table id="tbllistadoInformacionNegocio" class="table table-striped table-bordered table-condensed table-hover table table-responsive-md text-center" style="width: 100%;">
												<thead>
													<th>Id Negocio</th>
													<th>Nombre Negocio</th>
													<th>Referencia</th>
													<th>RFC</th>
													<th>Imagen Carousel</th>
													<th>Imagen Tarjetas</th>
													<th>Tipo Negocio</th>
													<th>Giro</th>
													<th>Editar</th>
													<th>Eliminar</th>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--Fin Sección Datos del negocio-->
								<!--Sección de Giros-->
								<div id="seccion4" class="panel-body">
									<h4 class="card-header text-left">Giros</h4>
									<div class="row" style="padding-top: 2%; padding-right: 1%;">
										<div class="col-lg-11 justify-content-end text-right">
											<button class="btn btn-success text-md-right" data-toggle="modal" data-target="#ventanaEditGiro" id="btnagregarGiro">
												<a class="nav-link" href="#" onclick="mostrarformGiro(true)">Agregar</a>
											</button><br/><br/>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<table id="tbllistadoGiro" class="table table-striped table-bordered table-condensed table-hover table table-responsive-md text-center" style="width: 100%;">
												<thead>
													<th>Id Giro</th>
													<th>Nombre del giro</th>
													<th>Descripción</th>
													<th>Tipo de giro</th>
													<th>Editar</th>
													<th>Eliminar</th>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!--Fin Sección de Giros-->
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			header("location: modulo_duenos.php");
		}

		require 'footer.php';
		?>
		<script src="scripts/modulo_administrador.js"></script>
		<script src="scripts/giro.js"></script>
		<script src="scripts/usuarios.js"></script>

		<?php
	}
	ob_end_flush();
	?>