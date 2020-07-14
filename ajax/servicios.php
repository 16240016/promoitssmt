<?php
session_start();
require_once "../modelos/Servicios.php";

$servicios = new Servicios();

$idservicio = isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";
$idinfo_negocio = isset($_POST["idinfo_negocio3"])? limpiarCadena($_POST["idinfo_negocio3"]):"";
$n_servicio = isset($_POST["n_servicio"])? limpiarCadena($_POST["n_servicio"]):"";
$d_servicio = isset($_POST["d_servicio"])? limpiarCadena($_POST["d_servicio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($idservicio)) {
		$rspta=$servicios->insertar($idinfo_negocio, $n_servicio,$d_servicio);
		echo $rspta ? "Servicio registrado" : "El servicio no se pudo registrar";
	}
	else {
		$rspta=$servicios->editar($idservicio, $n_servicio, $d_servicio);
		echo $rspta ? "Servicio actualizado" : "El servicio no se pudo actualizar";
	}
	break;
	
	case 'mostrar':
	$rspta=$servicios->mostrar($idservicio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$servicios->eliminar($idservicio);
	echo $rspta ? "Servicio eliminado" : "El servicio no se puede eliminar";
	break;
	
	case 'listar':
	$idinfo_negocio=$_GET['id'];
	$rspta=$servicios->listar($idinfo_negocio);
		//Declarrar array
	$data= Array();
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->idservicio,
			"1"=>$reg->n_servicio,
			"2"=>$reg->d_servicio,
			"3"=>'<button class="btn btn-primary" onclick="mostrarSer('.$reg->idservicio.')"><i class="fa fa-pencil"></i></button>',
			"4"=>'<button class="btn btn-danger" onclick="eliminarSer('.$reg->idservicio.')"><i class="fa fa-trash"></i></button>'
		);
	}
	$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data),//enviamos el totoal de registros al datatables
			"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
			"aaData"=>$data);
	echo json_encode($results);
	break;

}

?>