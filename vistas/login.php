<?php
require 'header.php';
?>
<div class="card mb-4 mx-auto" style="max-width: 50%;">
  <h4 class="card-header text-center">Inicio de sesión</h4><br />
  <form class="form-inline" id="formIniciarS" method="post" style="padding-bottom: 25px;">
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 form-inline">
      <label class="justify-content-end col-md-5">Usuario:</label>
      <input class="form-control col-md-5 col-sm-12" type="text" id="logina" name="logina" required/><br/><br/>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 form-inline">
      <label class="justify-content-end col-md-5">Contraseña:</label>
      <input class="form-control col-md-5 col-sm-12" type="password" id="clavea" name="clavea" required/><br/><br/><br/>
    </div>
    <div class="form-group col-lg-9 col-md-8 col-sm-8 col-xs-12 mx-auto justify-content-center">
      <button class="btn btn-primary col-lg-5 col-md-8" type="submit">Ingresar</button>
    </div>
  </form>
</div>
<?php
require 'footer.php';
?>
<script src="scripts/login.js"></script>