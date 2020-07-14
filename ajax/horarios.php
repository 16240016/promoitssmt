<?php
session_start();
require_once "../modelos/Horarios.php";

$horarios = new Horarios();

$idinfo_negocio = isset($_POST["idinfo_negocio4"])? limpiarCadena($_POST["idinfo_negocio4"]):"";
$tipo_servicio = isset($_POST["tipo_servicio"])? limpiarCadena($_POST["tipo_servicio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

	$rspta=$horarios->insertar($idinfo_negocio, $_POST['dias'], $_POST['he'], $_POST['hc'], $_POST['hs'], $tipo_servicio, $_POST['pago']);
	echo $rspta ? "Horarios registrados" : "Los horarios no se pueden registrar";
	break;

	case 'pagos':
	//Obtenemos todos los tipos de pagos de la tabla t_pago
	require_once "../modelos/T_Pago.php";
	$pago = new T_Pago();
	$rspta = $pago->listar();

		//Obtener permisos asignados
	$id=$_GET['id'];
	$marcados = $horarios->listarpagos($id);
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

	case 'datos':
		//Obtenemos todos los dias de la tabla dias
	require_once "../modelos/Dias.php";
	$dias = new Dias();
	$rspta = $dias->listar();

		//Obtener dias marcados
	$id=$_GET['id'];
	$marcados = $horarios->listarmarcados($id);
		//Declaramos el array para almacenar todos los dias marcados
	$dias_marcados=array();
	$hor_he=array();
	$hor_hc=array();
	$hor_hs=array();

		//Almacenar los dias marcados por el negocio en el array
	while ($dia = $marcados->fetch_object())
	{
		array_push($dias_marcados, $dia->iddia);
		array_push($hor_he, $dia->he);
		array_push($hor_hc, $dia->hc);
		array_push($hor_hs, $dia->hs);
	}
	echo count($hor_he);
	$i = 0;
		//Mostramos la lista de dias en la vista y si estan o no marcados
	while ($reg = $rspta->fetch_object())
	{
		
		if(in_array($reg->iddia, $dias_marcados))
		{
			$estado = 'checked';
			$estilo = 'style="display: block;"';
			$he = 'value="'.$hor_he[$i].'"';
			$hc = 'value="'.$hor_hc[$i].'"';
			$hs = 'value="'.$hor_hs[$i].'"';
		} else
		{
			$estado = 'checked';
			$estilo = 'style="display: block;"';
			$he = '';
			$hc = '';
			$hs = '';
		}
		if($i==0){
			echo '<label class="text-center col-12">Días de atención entre semana</label><br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" '.$estado.' name="dias[]" value="'.$reg->iddia.'">
			<label class="form-check-label col-md-4 justify-content-start" for="'.$reg->n_dia.'">'.$reg->n_dia.'</label>
			</div>
			<div id="hor'.$reg->n_dia.'" '.$estilo.'>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
			<input class="form-control" type="time" id="he'.$reg->n_dia.'" name="he[]" '.$he.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
			<input class="form-control" type="time" id="hc'.$reg->n_dia.'" name="hc[]" '.$hc.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
			<input class="form-control" type="time" id="hs'.$reg->n_dia.'" name="hs[]" '.$hs.' /><br />
			</div><br />
			<div class="form-check form-check-inline col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<input class="form-check-input" type="checkbox" id="todos">
			<label class="form-check-label" for="todos">Mismo horario de Lunes a Viernes</label>
			</div>
			</div><br />';
		} else if($i==5){
			echo '<label class="text-center col-12">Días de atención en fin de semana</label><br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" '.$estado.' id="diasF'.$i.'" name="dias[]" value="'.$reg->iddia.'">
			<label class="form-check-label col-md-4 justify-content-start" for="'.$reg->n_dia.'">'.$reg->n_dia.'</label>
			</div>
			<div id="hor'.$reg->n_dia.'" '.$estilo.'>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
			<input class="form-control" type="time" id="he'.$reg->n_dia.'" name="he[]" '.$he.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
			<input class="form-control" type="time" id="hc'.$reg->n_dia.'" name="hc[]" '.$hc.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
			<input class="form-control" type="time" id="hs'.$reg->n_dia.'" name="hs[]" '.$hs.' /><br />
			</div><br />
			</div>';
		} else if($i==6){
			echo '<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" '.$estado.' id="diasF'.$i.'" name="dias[]" value="'.$reg->iddia.'">
			<label class="form-check-label col-md-4 justify-content-start" for="'.$reg->n_dia.'">'.$reg->n_dia.'</label>
			</div>
			<div id="hor'.$reg->n_dia.'" '.$estilo.'>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
			<input class="form-control" type="time" id="he'.$reg->n_dia.'" name="he[]" '.$he.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
			<input class="form-control" type="time" id="hc'.$reg->n_dia.'" name="hc[]" '.$hc.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
			<input class="form-control" type="time" id="hs'.$reg->n_dia.'" name="hs[]" '.$hs.' /><br />
			</div>
			</div>
			</div><br />';
		} else {
			echo '<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" '.$estado.' id="diasE'.$i.'" name="dias[]" value="'.$reg->iddia.'">
			<label class="form-check-label col-md-4 justify-content-start" for="'.$reg->n_dia.'">'.$reg->n_dia.'</label>
			</div>
			<div id="hor'.$reg->n_dia.'" '.$estilo.'>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de apertura:</label>
			<input class="form-control" type="time" id="he'.$reg->n_dia.'" name="he[]" '.$he.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de comida:</label>
			<input class="form-control" type="time" id="hc'.$reg->n_dia.'" name="hc[]" '.$hc.' />
			</div>
			<div class="form-group">
			<label class="justify-content-end col-lg-6 col-md-6 col-sm-6 col-xs-6">Horario de cierre:</label>
			<input class="form-control" type="time" id="hs'.$reg->n_dia.'" name="hs[]" '.$hs.' /><br />
			</div><br />
			</div>';
		}
		$i++;
	}
	break;
	
}

?>