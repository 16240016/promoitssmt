<?php
session_start();
require_once "../modelos/Info_Negocio.php";

$info_negocio = new Info_Negocio();

$idinfo_negocio = isset($_POST["idinfo_negocio"])? limpiarCadena($_POST["idinfo_negocio"]):"";
$idpersonal = isset($_POST["idpersonal2"])? limpiarCadena($_POST["idpersonal2"]):"";
$idgiro = isset($_POST["idgiro"])? limpiarCadena($_POST["idgiro"]):"";
$n_negocio = isset($_POST["n_negocio"])? limpiarCadena($_POST["n_negocio"]):"";
$ref_negocio = isset($_POST["ref_negocio"])? limpiarCadena($_POST["ref_negocio"]):"";
$rfc_negocio = isset($_POST["rfc_negocio"])? limpiarCadena($_POST["rfc_negocio"]):"";
$url_imagen1 = isset($_POST["url_imagen1"])? limpiarCadena($_POST["url_imagen1"]):"";
$url_imagen2 = isset($_POST["url_imagen2"])? limpiarCadena($_POST["url_imagen2"]):"";
$tipo_negocio = isset($_POST["tipo_negocio"])? limpiarCadena($_POST["tipo_negocio"]):"";
$tipo_servicio = isset($_POST["tipo_servicio"])? limpiarCadena($_POST["tipo_servicio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	
	//Imagen de carousel
	if (!file_exists($_FILES['url_imagen1']['tmp_name']) || !is_uploaded_file($_FILES['url_imagen1']['tmp_name']))
	{
		$url_imagen1=$_POST["imagenactual1"];
	}
	else {
		$ext = explode(".", $_FILES["url_imagen1"]["name"]);
		if ($_FILES['url_imagen1']['type'] == "image/jpg" || $_FILES['url_imagen1']['type'] == "image/jpeg" || $_FILES['url_imagen1']['type'] == "image/png")
		{
			$url_imagen1 = round((microtime(true)) . '.' . end($ext));
			move_uploaded_file($_FILES["url_imagen1"]["tmp_name"], "../files/img_negocios_carousel/" .$url_imagen1);
		}
	}


	//Imagen de tarjetas
	if (!file_exists($_FILES['url_imagen2']['tmp_name']) || !is_uploaded_file($_FILES['url_imagen2']['tmp_name']))
	{
		$url_imagen2=$_POST["imagenactual2"];
	}
	else {
		$ext = explode(".", $_FILES["url_imagen2"]["name"]);
		if ($_FILES['url_imagen2']['type'] == "image/jpg" || $_FILES['url_imagen2']['type'] == "image/jpeg" || $_FILES['url_imagen2']['type'] == "image/png")
		{
			$url_imagen2 = round((microtime(true)) . '.' . end($ext));
			move_uploaded_file($_FILES["url_imagen2"]["tmp_name"], "../files/img_negocios_tarjetas/" .$url_imagen2);
		}
	}

	$rspta=$info_negocio->editar($idinfo_negocio, $idpersonal, $idgiro, $n_negocio, $ref_negocio, $rfc_negocio, $url_imagen1, $url_imagen2, $tipo_negocio, $tipo_servicio, $_POST['pago']);
	echo $rspta ? "La información se actualizó" : "La información no se pudo actualizar";
	
	break;
	
	case 'mostrar':
	$rspta=$info_negocio->mostrar($idinfo_negocio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;
	
	case 'eliminar':
	$rspta=$info_negocio->eliminar($idinfo_negocio);
	echo $rspta ? "Datos eliminados" : "Los datos no se pueden eliminar";
	break;
	
	case 'listar':
	$rspta=$info_negocio->listar();
		//Declarrar array
	$data= Array();
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->idinfo_negocio,
			"1"=>$reg->n_negocio,
			"2"=>$reg->ref_negocio,
			"3"=>$reg->rfc_negocio,
			"4"=>"<img src='../files/img_negocios_carousel/".$reg->url_imagen1."' heigth='50px' width='50px' >",
			"5"=>"<img src='../files/img_negocios_tarjetas/".$reg->url_imagen2."' heigth='50px' width='50px' >",
			"6"=>$reg->tipo_negocio,
			"7"=>$reg->n_giro,
			"8"=>'<button class="btn btn-primary" onclick="moostrar('.$reg->idinfo_negocio.')"><i class="fa fa-pencil"></i></button>',
			"9"=>'<button class="btn btn-danger" onclick="eliminar('.$reg->idinfo_negocio.')"><i class="fa fa-trash"></i></button>'
		);
	}
	$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data),//enviamos el totoal de registros al datatables
			"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
			"aaData"=>$data);
	echo json_encode($results);
	break;

	case 'selectGiro':

	require_once "../modelos/Giro.php";

	$giro = new Giro();

	//se almacena la variable negocio para utilizarla en metodo selectG
	$id=$_GET['negocio'];

	//Se obtiene el giro del negocio logueado
	$select = $info_negocio->selectG($id);

	//Se obtienen todos los giros
	$rspta = $giro->listar();

	//Declaramos el array para almacenar el giro seleccionado
	$gir=array();

	//Se almacena el giro seleccionado por el dueño en el array gir
	while ($g = $select->fetch_object())
	{
		array_push($gir, $g->idgiro);
	}

	echo '<option value="">Seleccione un giro</option>';

	while ($reg = $rspta->fetch_object())
	{
		$sw=in_array($reg->idgiro, $gir)?'selected="true"' :'';
		echo '<option value='. $reg->idgiro . ' '.$sw.'>' . $reg->n_giro . '</option>';
	}
	break;


	case 'obtenerTipo':
	$rspta=$info_negocio->tipo($idinfo_negocio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'elegirTipo':
	$tipo=$_GET['tipo'];


	if($tipo=="PRODUCTOS"){
		echo '<a class="nav-link" href="#" onclick="mostrarSeccion5(true)">'.$tipo.'</a>';
	} else if ($tipo=="SERVICIOS"){
		echo '<a class="nav-link" href="#" onclick="mostrarSeccion6(true)">'.$tipo.'</a>';
	} else {
		echo '<a class="nav-link" href="#" onclick="mostrarSeccion5(true)">PRODUCTOS / SERVICIOS</a>';
	}

	break;

	case 'pagos':
	//Obtenemos todos los tipos de pagos de la tabla t_pago
	require_once "../modelos/T_Pago.php";
	$pago = new T_Pago();
	$rspta = $pago->listar();

		//Obtener permisos asignados
	$id=$_GET['id'];
	$marcados = $info_negocio->listarpagos($id);
		//Declaramos el array para almacenar todos los pagos marcados
	$valores=array();

		//Almacenar los pagos tipos de pagos asignados al dueño en el array
	while ($pa = $marcados->fetch_object())
	{
		array_push($valores, $pa->idpago);
	}

		//Mostramos la lista de pagos en la vista y si estan o no marcados
	while ($reg = $rspta->fetch_object())
	{
		$sw=in_array($reg->idpago, $valores)?'checked' :'';
		echo '<li> <input type="checkbox" '.$sw.' name="pago[]" value="'.$reg->idpago.'"> '.$reg->tipo_pago.'</li>';
	}
	break;

	case 'carousel':
	$rspta=$info_negocio->carousel();
	
	echo '<h3 class="card-title">COMERCIOS DE LA REGIÓN</h3>
	<br />
	<!--BLOQUE DEL  CARRUSELl-->
	<div id="demo" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ul class="carousel-indicators">';

	$i = 0;
	while($reg = $rspta->fetch_object())
	{
		if($i==0){
			echo '<li data-target="#demo" data-slide-to="'.$i.'" class="active"></li>';
		} else {
			echo '<li data-target="#demo" data-slide-to="'.$i.'"></li>';
		}
		$i++;
	}

	echo '</ul>
	<!-- The slideshow -->
	<div class="carousel-inner">';

	$rspta=$info_negocio->carousel();

	$i = 0;
	while($datos = $rspta->fetch_object())
	{
		if($i==0){
			echo	'<div class="carousel-item active">
			<img src="../files/img_negocios_carousel/'.$datos->url_imagen1.'" class="img-fluid" width="1300" height="900">
			<div class="carousel-caption d-none d-md-block" style="background-image: linear-gradient(rgba(221,228,230, 0.3), rgba(0,0,0,1));">
    		<h2 style="color: #ffffff;">'.$datos->n_negocio.'</h2>
   			<p style="color: #ffffff;">'.$datos->ref_negocio.'</p>
  			</div>
			</div>';
		} else {
			echo	'<div class="carousel-item">
			<img src="../files/img_negocios_carousel/'.$datos->url_imagen1.'" class="img-fluid" width="1300" height="900">
			<div class="carousel-caption d-none d-md-block" style="background-image: linear-gradient(rgba(221,228,230, 0.3), rgba(0,0,0,1));">
    		<h2 style="color: #ffffff;">'.$datos->n_negocio.'</h2>
    		<p style="color: #ffffff;">'.$datos->ref_negocio.'</p>
    		</div>
			</div>';
		}
		$i++;
	}

	echo '</div>
	<!-- Left and right controls -->
	<a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon"></span>
	</a>
	<a class="carousel-control-next" href="#demo" role="button" data-slide="next">
	<span class="carousel-control-next-icon"></span>
	</a>
	</div>';
	break;

	case 'consultaProductos':
	$giro = $_POST['giro'];

	$rspta = $info_negocio->tarjetas($giro);

	while($reg = $rspta->fetch_object())
	{
		echo '<div class="card mb-4 mx-auto" style="max-width: 80%">
    			<h4 class="card-header">'.$reg->n_negocio.'</h4>
    				<div class="row">
      					<div class="col-md-3" style="margin: 3% 3% 3% 3%">
      						<img src="../files/img_negocios_tarjetas/'.$reg->url_imagen2.'" class="card-img rounded-circle" alt="..." width="200px" height="300px">
      					</div>
      					<div class="col-md-6">
        					<div class="card-body">
          						<p class="card-text">Referencia: '.$reg->ref_negocio.'</p>
          						<p class="card-text">Dirección: '.$reg->direccion.'</p>
          						<p class="card-text">Teléfono del local: '.$reg->num_local.'</p>
          						<p class="card-text">Correo electrónico: '.$reg->correo_n.'</p>
          						<p class="card-text">Horarios</p>
          						<div id="horarios">
          							<ul style="list-style: none">
          								<li><strong>Lunes</strong> '.$reg->lunes.'</li>
          								<li><strong>Martes</strong> '.$reg->martes.'</li>
          								<li><strong>Miércoles</strong> '.$reg->miercoles.'</li>
          								<li><strong>Jueves</strong> '.$reg->jueves.'</li>
          								<li><strong>Viernes</strong> '.$reg->viernes.'</li>
          								<li><strong>Sábado</strong> '.$reg->sabado.'</li>
          								<li><strong>Domingo</strong> '.$reg->domingo.'</li>
          							</ul>
          						</div>
          						<p class="card-text">Servicio de entrega: '.$reg->tipo_servicio.'</p>
          						<p class="card-text">Metodos de pago:</p>
          						<div>
          							<ul>';
          						$rspta2 = $info_negocio->listarpagosTarjetas($reg->id);
          						while($pagos = $rspta2->fetch_object())
          						{
          							echo '<li>'.$pagos->nombre_pago.'</li>';
          						}

          						echo '</ul>
          							</div>
          						<p class="card-text">Redes Sociales</p>
          						<div>';

          						if($reg->dir_face!=''){
          							echo '<a href="'.$reg->dir_face.'" target="_blank"><img src="../public/img/face.png"></a>';
          						}
          						if($reg->dir_twiter!=''){
          							echo '<a href="'.$reg->dir_twiter.'" target="_blank"><img src="../public/img/twiter.png"></a>';
          						}
          						if($reg->num_whats!=''){
          							echo '<a href="https://api.whatsapp.com/send?phone=52'.$reg->num_whats.'&text=Hola,%20¿qué%20tal?" target="_blank"><img src="../public/img/whatsapp.png" width="30px" height="30px"></a>';
          						}
          						echo '</div>
        					</div>
      					</div>   
    				</div>
  				</div>';
	}

	break;
	
}

?>