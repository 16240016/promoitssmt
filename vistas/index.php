<?php
session_start();
if (!isset($_SESSION["n_usuario"])) {
  require 'header.php';
  ?>
  <!--ENCABEZADO DEL CUERPO DE LA PAGINA--> 
  <div class="card-header" id="menuBotones">
   <nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item">
        <button class="btn btn-light">
          <a class="nav-link" href="index.php">INICIO</a>
        </button>
      </li>
      <li class="nav-item">
        <button class="btn btn-light">
          <a class="nav-link" href="#" onclick="mostrarProductos(true)">PRODUCTOS</a>
        </button>
      </li>
      <li class="nav-item">
        <button class="btn btn-light">
          <a class="nav-link" href="#" onclick="mostrarServicios(true)">SERVICIOS</a>
        </button>
      </li>
      <li class="nav-item">
        <button class="btn btn-light" data-toggle="modal" data-target="#ventanaModal">
          <a class="nav-link" href="#" onclick="mostrarForm(true)">INICIAR SESIÓN</a>
        </button>
      </li>
    </ul>
  </nav>
</div>
<!--Modal de inicio de sesión-->
<div class="modal fade" id="ventanaModal" tabindex="-11" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true" align="center" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Inicio de encabezado-->
      <div class="modal-header justify-content-center" style="background-color: #424874;">
        <h5 id="tituloVentana" style="color: #ffffff">Iniciar Sesión</h5>
      </div>
      <!--Fin inicio de encabezado-->
      <!--Cuerpo de encabezado-->
      <div class="modal-body justify-content-center" id="formulario" style="background-color: #a6b1e1;">
        <div>
          <form class="form-inline" id="formIniciarS" method="post">
            <div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12">
              <label class="control-label col-md-4">Usuario</label>
              <input class="form-control col-md-8" type="text" id="logina" name="logina" required/><br/><br/><br/>
            </div>
            <div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-12">
              <label class="control-label col-md-4" >Contraseña</label>
              <input class="form-control col-md-8" type="password" id="clavea" name="clavea" required/><br/><br/><br/>
            </div>
            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 mx-auto">
              <button class="btn btn-primary col-5" type="submit" style="margin-right: 15px" >Ingresar</button>
              <button class="btn btn-danger col-5" type="button" data-dismiss="modal">Cerrar</button>
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
<!--Fin Modal de inicio de sesión-->
<!--Caroucel-->
<div class="card text-center" id="divCarousel">
	
</div>
<!--Fin Carousel-->
<br /><br />
<!--Opciones de productos-->
<div class="row justify-content-center" id="selectProductos">
	<div class="col-sm-11">
		<h4>Productos</h4>
		<div class="row justify-content-center">
			<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<select class="form-control" id="idgiro" name="idgiro" required>
					
				</select>
			</div>
		</div>
	</div>
</div>
<!--Opciones de servicios-->
<div class="row justify-content-center" id="selectServicios">
	<div class="col-sm-11">
		<h4>Servicios</h4>
		<div class="row justify-content-center">
			<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<select class="form-control" id="idgiro2" name="idgiro2" required>
					
				</select>
			</div>
		</div>
	</div>
</div>
<!--Sección de consultas--> 
<div id="divConsultas">
	
</div>
<?php
require 'footer.php';
} else {
  if ($_SESSION['n_usuario']!='admin')
  {
    header("location: modulo_duenos.php");
  } else if ($_SESSION['n_usuario']=='admin') 
  {
    header("location: modulo_administrador.php");
  }
}
?>
<script src="scripts/index.js"></script>
<script src="scripts/login.js"></script>