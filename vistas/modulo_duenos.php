<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
$per = $_SESSION['idpersonal'];
$nego = $_SESSION['idinfo_negocio'];
$tipo = $_SESSION['tipo_negocio'];

if (!isset($_SESSION["n_usuario"])) {
	header("location: login.php");
}
else
{
	require 'header.php';

	if ($_SESSION['n_usuario']!='admin')
	{
		?>
		<strong class="nav-link text-right"><?php echo $_SESSION['nombre']; ?></strong>
		<!--ENCABEZADO DEL CUERPO DE LA PAGINA-->
		<div class="card-header" id="menuBotones">
			<nav class="navbar navbar-expand-sm bg-light justify-content-center">
				<ul class="navbar-nav">
					<li class="nav-item">
						<button class="btn btn-light">
							<a class="nav-link" href="#" onclick="mostrarSeccion1(true)">DATOS PERSONALES</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light">
							<a class="nav-link" href="#" onclick="mostrarSeccion2(true)">DATOS DEL NEGOCIO</a>
						</button>
					</li>
					<li class="nav-item">
						<button class="btn btn-light">
							<a class="nav-link" href="#" onclick="mostrarSeccion8(true)">BÚSQUEDA DE INSUMOS</a>
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
		<!--Formulario Datos personales-->
		<div class="card" style="max-width: 90%; margin: 0 auto; float: none; margin-bottom: 3%; margin-top: 3%;">
			<!-- Main content -->
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="card-header" id="menuDatosNegocio">
								<nav class="navbar navbar-expand-sm bg-light justify-content-star">
									<ul class="nav nav-tabs">
										<li class="nav-item">
											<a class="nav-link active" href="#" onclick="mostrarSeccion2(true)">INFORMACIÓN</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#" onclick="mostrarSeccion3(true)">DIRECCIÓN</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#" onclick="mostrarSeccion4(true)">HORARIOS</a>
										</li>
										<li class="nav-item" id="tipo_bd">
											
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#" onclick="mostrarSeccion7(true)">REDES SOCIALES</a>
										</li>
									</ul>
								</nav>
							</div>
							<div id="seccion1" class="panel-body"><br />
								<h4 class="card-header text-left">Datos Personales</h4><br />
								<input type="hidden" name="id" id="id" value=<?php echo $per ?>>
								<input type="hidden" name="tip" id="tip">
								<form id="formDatosPer" method="post" class="form-inline">
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Nombre (s):</label>
										<input type="hidden" name="idpersonal" id="idpersonal">
										<input type="hidden" name="idusuario" id="idusuario">
										<input class="form-control col-md-8" type="text" id="nombres" name="nombres" maxlength="20" required/><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Apellido Paterno:</label>
										<input class="form-control col-md-8" type="text" id="a_paterno" name="a_paterno" maxlength="20" required/><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Apellido Materno:</label>
										<input class="form-control col-md-8" type="text" id="a_materno" name="a_materno" maxlength="20" required/><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">RFC:</label>
										<input class="form-control col-md-8" type="text" id="rfc_usuario" name="rfc_usuario" maxlength="13"/><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Número telefónico:</label>
										<input class="form-control col-md-8" type="tel" id="n_telefono" name="n_telefono" maxlength="15" /><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Nombre de Usuario:</label>
										<input class="form-control col-md-8" type="text" id="n_usuario" name="n_usuario" maxlength="15" required/><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Correo Electrónico:</label>
										<input class="form-control col-md-8" type="text" id="correo_usu" name="correo_usu" maxlength="30" /><br /><br /><br />
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="justify-content-end col-md-4">Contraseña:</label>
										<input class="form-control col-md-8" type="text" id="c_usuario" name="c_usuario" maxlength="15" required/><br />
									</div>
									<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-center" style="padding-top: 10px; padding-bottom: 15px;">
										<button type="submit" class="btn btn-primary" id="btnGuardarDP">Guardar Información</button>
									</div>
								</form>
							</div>
							<!--Fin Formulario Datos personales-->
							<!--Formulario Información del negocio-->
							<div id="seccion2">
								<h4 class="card-header text-center">Información del negocio</h4>
								<input type="hidden" name="negocio" id="negocio" value=<?php echo $nego ?>>
								<form class="" id="formDatosNInformacion" method="post"><br />
									<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 form-inline">
										<label for="n_negocio" class="justify-content-end col-md-4">Nombre del negocio:</label>
										<input type="hidden" name="idinfo_negocio" id="idinfo_negocio">
										<input type="hidden" name="idpersonal2" id="idpersonal2">
										<input class="form-control col-md-6" type="text" id="n_negocio" name="n_negocio" maxlength="45" required/><br />
									</div>
									<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 form-inline">
										<label for="ref_negocio" class="justify-content-end col-md-4">Referencia del negocio:</label>
										<input class="form-control col-md-6" type="text" id="ref_negocio" name="ref_negocio" maxlength="45" required/><br />
									</div>
									<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 form-inline">
										<label for="rfc_negocio" class="justify-content-end col-md-4">RFC:</label>
										<input class="form-control col-md-6" type="text" id="rfc_negocio" name="rfc_negocio" maxlength="13"/><br />
									</div>
									<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 form-inline">
										<label for="url_imagen1" class="justify-content-end col-md-4">Adjuntar imagen del negocio:</label>
										<input class="col-md-6" type="file" name="url_imagen1" id="url_imagen1"/>
										<input type="hidden" name="imagenactual1" id="imagenactual1"/><br />
										<img src=""	width="150px" height="120px" id="imagenmuestra1"/><br />					
									</div>
									<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 form-inline">
										<label for="url_imagen2" class="justify-content-end col-md-4">Adjuntar imagen del negocio:</label>
										<input class="col-md-6" type="file" name="url_imagen2" id="url_imagen2"/>
										<input type="hidden" name="imagenactual2" id="imagenactual2"/><br />
										<img src=""	width="150px" height="120px" id="imagenmuestra2"/><br />					
									</div>
									<div class="form-inline">
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Tipo de negocio:</label>
											<select class="form-control col-lg-6 col-md-6 col-sm-6 col-xs-12" name="tipo_negocio" id="tipo_negocio" required>
												<option value="PRODUCTOS">Productos</option>
												<option value="SERVICIOS">Servicios</option>
											</select>
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Giro del negocio:</label>
											<select class="form-control col-lg-6 col-md-6 col-sm-6 col-xs-12" name="idgiro" id="idgiro" required>
											</select>
										</div><br /><br /><br /><br />
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Servicio*:</label><br />
											<select class="form-control col-lg-6 col-md-6 col-sm-6 col-xs-12" name="tipo_servicio" id="tipo_servicio" required>
												<option value="Sólo en local">Sólo en local</option>
												<option value="Sólo a domicilio">Sólo a domicilio</option>
												<option value="En local y a domicilio">Ambos</option>
											</select>
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Tipo de pago:</label>
											<ul class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-8" style="list-style: none" id="t_pagos">
											</ul>
										</div>	
									</div><br />
										
										<div class="form-group row col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-end" style="padding-top: 10px; padding-bottom: 15px;">
											<button type="submit" class="btn btn-primary " id="btnGuardarIN">Guardar Información</button>
										</div>
									</form>
								</div>
								<!--Fin Formulario Información del negocio-->
								<!--Formulario Dirección del negocio-->
								<div id="seccion3"><br />
									<h4 class="card-header text-center">Dirección del Negocio</h4><br />
									<input type="hidden" name="negocio2" id="negocio2" value=<?php echo $nego ?>>
									<form id="formDatosNDireccion" method="post" class="form-inline">
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Calle: *</label> 
											<input type="hidden" name="iddireccion" id="iddireccion">
											<input class="form-control col-md-8" type="text" id="calle" name="calle" maxlength="45" required/><br /><br /><br />
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Número: *</label>
											<input class="form-control col-md-8" type="number" id="numero" name="numero" maxlength="10" required/><br /><br /><br />
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Código postal: *</label>
											<select class="form-control col-lg-6 col-md-6 col-sm-6 col-xs-12" name="idlocalidad" id="idlocalidad" required><br /><br /><br />
											</select>
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Municipio: *</label>
											<select class="form-control col-lg-6 col-md-6 col-sm-6 col-xs-12" name="municipio" id="municipio">
												<option value="San Martín Texmelucan" selected>San Martín Texmelucan</option>
											</select><br /><br /><br /><br />
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="justify-content-end col-md-4">Estado: *</label>
											<select class="form-control selectpicker col-lg-6 col-md-6 col-sm-6 col-xs-12" name="estado" id="estado">
												<option value="Puebla" selected>Puebla</option>
											</select>
										</div>		
										<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-center" style="padding-top: 20px; padding-bottom: 15px;">
											<button type="submit" class="btn btn-primary" id="btnGuardarD">Guardar Información</button>
										</div>
									</form>
								</div>
								<!--Fin Formulario Direccion del negocio-->
								<!--Formulario Horarios del negocio-->
								<div id="seccion4">
									<h4 class="card-header text-center">Horarios y Días de Atención del Negocio</h4><br />
									<form id="formDatosNHorario" method="post" class="form-inline">
										<input type="hidden" name="iddias_horario" id="iddias_horario">
										<div id="secDias" class="justify-content-center col-lg-12 col-md-12 col-sm-12 col-xs-12r">
											<label class="text-center col-12">Días de atención entre semana</label><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="lunes">Lunes</label>
											</div>
											<div id="horLunes" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_lun" name="he_lun" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_lun" name="hc_lun" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_lun" name="hs_lun" /><br />
												</div><br />
												<div class="form-check form-check-inline col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<label class="form-check-label" for="todos"  style="padding-right-right: 10px; margin-right: 15px">Mismo horario de Lunes a Viernes
													</label>
													<button type="button" class="btn btn-success" onclick="copiarHorarios()">Click</button>
												</div>
											</div><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="martes">Martes</label>
											</div>
											<div id="horMartes" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_mar" name="he_mar" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_mar" name="hc_mar" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_mar" name="hs_mar" /><br />
												</div>
											</div><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="miercoles">Miércoles</label>
											</div>
											<div id="horMiercoles" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_mie" name="he_mie" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_mie" name="hc_mie" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_mie" name="hs_mie" /><br />
												</div>
											</div><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="jueves">Jueves</label>
											</div>
											<div id="horJueves" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_jue" name="he_jue" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_jue" name="hc_jue" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_jue" name="hs_jue" /><br />
												</div>
											</div><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="viernes">Viernes</label>
											</div>
											<div id="horViernes" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_vie" name="he_vie" />
												</div><br />
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_vie" name="hc_vie" />
												</div><br />
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_vie" name="hs_vie" /><br />
												</div>
											</div><br /><br /><br />
											<label class="text-center col-12">Días de atención en fin de semana</label><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="sabado">Sábado</label>
											</div>
											<div id="horSabado" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_sab" name="he_sab" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_sab" name="hc_sab" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_sab" name="hs_sab" /><br />
												</div>
											</div><br />
											<div class="form-check form-check-inline">

												<label class="form-check-label col-md-4 justify-content-start" for="domingo">Domingo</label>
											</div><br /><br />
											<div id="horDomingo" style="display: block;">
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
													<input class="form-control" type="time" id="he_dom" name="he_dom" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
													<input class="form-control" type="time" id="hc_dom" name="hc_dom" />
												</div>
												<div class="form-group">
													<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
													<input class="form-control" type="time" id="hs_dom" name="hs_dom" /><br />
												</div>
											</div>
										</div><br />
										<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-end" style="padding-top: 10px; padding-bottom: 15px;">
											<button type="submit" class="btn btn-primary" id="btnGuardarHor">Guardar Información</button>
										</div>
									</form>
								</div>
								<!--Fin Formulario Horarios del negocio-->
								<!--Formulario Productos del negocio-->
								<div id="seccion5" >
									<h5 class="card-header text-center">Registro de Productos</h5>
									<form id="formDatosNProductos" method="post" class="form-inline">
										<div class="form-group col-lg-10 col-md-12 col-sm-6 col-xs-12" style="margin-top 20px;">
											<label for="nombre_neg" class="justify-content-end col-md-4">Nombre del Producto *:</label>
											<input type="hidden" name="idinfo_negocio2" id="idinfo_negocio2" value=<?php echo $nego ?>>
											<input type="hidden" name="idproductos" id="idproductos">
											<input class="form-control col-md-4 justify-content-end" type="text" id="n_producto" name="n_producto" maxlength="45" required/><br /><br /><br />
										</div>
										<div class="form-group col-lg-10 col-md-10 col-sm-6 col-xs-12">
											<label for="nombre_neg" class="justify-content-end col-md-4">Marca del producto *:</label>
											<input class="form-control col-md-4 justify-content-end" type="text" id="m_producto" name="m_producto" maxlength="10" required/>
											<div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 justify-content-end" style="padding-top: 10px;">
												<button type="submit" class="btn btn-primary" id="btnGuardarPro" style="margin-right: 15px">Guardar Producto</button>
												<button class="btn btn-success" onclick="limpiarPro()">Limpiar</button>
											</div>
										</div>
									</form><br/><br />
									<div class="row">
										<div class="col-md-10 mx-auto">
											<table id="tbllistadoProductos" class="table table-striped table-bordered table-condensed table-hover text-center table table-responsive-md" style="width: 100%;">
												<thead>
													<th class="text-center">Id de producto</th>
													<th class="text-center">Nombre de producto</th>
													<th class="text-center">Marca del producto</th>
													<th class="text-center">Modificar</th>
													<th class="text-center">Eliminar</th>
												</thead>

												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--Fin Formulario Productos del negocio-->
								<!--Formulario Servicios del negocio-->
								<div id="seccion6" >
									<h5 class="card-header text-center">Registro de Servicios</h5>
									<form id="formDatosNServicios" method="post" class="form-inline">
										<div class="form-group col-lg-11 col-md-12 col-sm-6 col-xs-12" style="margin-top 20px;">
											<label for="nombre_neg" class="justify-content-end col-md-4">Nombre del Servicio *:</label>
											<input type="hidden" name="idinfo_negocio3" id="idinfo_negocio3" value=<?php echo $nego ?>>
											<input type="hidden" name="idservicio" id="idservicio">
											<input class="form-control col-md-4 justify-content-end" type="text" id="n_servicio" name="n_servicio" maxlength="10" required/><br /><br /><br />
										</div>
										<div class="form-group col-lg-11 col-md-10 col-sm-6 col-xs-12">
											<label for="nombre_neg" class="justify-content-end col-md-4">Descripción del producto *:</label>
											<textarea class="form-control col-md-8" type="text" id="d_servicio" name="d_servicio" maxlength="250" rows="4" cols="6" required></textarea>
										</div>
										<div class="form-group col-lg-11 col-md-12 col-sm-12 col-xs-12 justify-content-center" style="padding-top: 10px;">
											<button type="submit" class="btn btn-primary" id="btnGuardarSer" style="margin-right: 15px">Guardar Servicio</button>
											<button class="btn btn-success" onclick="limpiarSer()">Limpiar</button>
										</div>
									</form>
									<div class="row">
										<div class="col-md-10 mx-auto">
											<table id="tbllistadoServicios" class="table table-striped table-bordered table-condensed table-hover text-center table table-responsive-md" style="width: 100%;">
												<thead>
													<th class="text-center">Id de servicio</th>
													<th class="text-center">Nombre de servicio</th>
													<th class="text-center">Descripción del servicio</th>
													<th class="text-center">Modificar</th>
													<th class="text-center">Eliminar</th>
												</thead>

												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--Fin Formulario Servicios del negocio-->
								<!--Formulario Redes Sociales del Negocio-->

								<div id="seccion7">
									<h4 class="card-header text-center">Redes Sociales</h4><br />
									<form id="formDatosNRedes" method="post" class="form-inline"><br />
										<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12 text-center">
											<label for="correo_n" class="justify-content-end col-md-4">Correo Electrónico:</label>
											<input type="hidden" name="idredes_sociales" id="idredes_sociales">
											<input class="form-control col-md-6 justify-content-end" type="text" id="correo_n" name="correo_n" maxlength="45" /><br /><br />
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12 text-center">
											<label for="num_local" class="justify-content-end col-md-4">Número de teléfono local:</label><br />
											<input class="form-control col-md-6 justify-content-end" type="tel" id="num_local" name="num_local" maxlength="10" /><br /><br />
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12 text-center">
											<label for="num_whats" class="justify-content-end col-md-4">Número de WhatsApp:</label>
											<input class="form-control col-md-6 justify-content-end" type="tel" id="num_whats" name="num_whats" maxlength="10" /><br /><br />
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12 text-center">
											<label for="dir_face" class="justify-content-end col-md-4">Dirección de Facebook:</label>
											<input class="form-control col-md-6 justify-content-end" type="text" id="dir_face" name="dir_face" maxlength="100"/><br /><br />
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12 text-center">
											<label for="dir_twiter" class="justify-content-end col-md-4">Dirección de Twitter:</label>
											<input class="form-control col-md-6 justify-content-end" type="text" id="dir_twiter" name="dir_twiter" maxlength="100" /><br />
										</div>
										<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-end" style="padding-top: 10px; padding-bottom: 15px;">
											<button type="submit" class="btn btn-primary" id="btnGuardarRS">Guardar Información</button>
										</div>
									</form>
								</div>
								<!--Fin Formulario Redes Sociales del Negocio-->
								<!--Formulario Busqueda de Insumos-->
								<div id="seccion8">
									<h4 class="card-header text-left">Búsqueda de Insumos</h4>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<table id="tbllistadoInsumos" class="table table-striped table-bordered table-condensed table-hover table table-responsive text-center" style="width: 100%;">
												<thead>
													<tr>
														<th class="text-center" rowspan="2">Nombre</th>
														<th class="text-center" rowspan="2">Descripción / Marca</th>
														<th class="text-center" rowspan="2">Nombre Negocio</th>
														<th class="text-center" rowspan="2">Dirección</th>
														<th class="text-center" rowspan="2">Teléfono</th>
														<th class="text-center" colspan="7">Horarios</th>
													</tr>
													<tr>
														<th class="text-center">Lunes</th>
														<th class="text-center">Martes</th>
														<th class="text-center">Miercoles</th>
														<th class="text-center">Jueves</th>
														<th class="text-center">Viernes</th>
														<th class="text-center">Sabado</th>
														<th class="text-center">Domingo</th>
													</tr>
												</thead>

												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Fin Formulario Busqueda de Insumos-->
			<?php
		}
		else
		{
			header("location: modulo_administrador.php");
		}

		require 'footer.php';
		?>
		<script src="scripts/dias_horario.js"></script>
		<script src="scripts/servicios.js"></script>
		<script src="scripts/productos.js"></script>
		<script src="scripts/redes_sociales.js"></script>
		<script src="scripts/info_negocio.js"></script>
		<script src="scripts/direccion.js"></script>
		<script src="scripts/datos_personales.js"></script>
		<script src="scripts/modulo_dueno.js"></script>
		<?php
	}
	ob_end_flush();

	?>