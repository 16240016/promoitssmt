<?php
session_start();
require_once "../modelos/Giro.php";

$giro = new Giro();

$idgiro = isset($_POST["idgiro"])? limpiarCadena($_POST["idgiro"]):"";
$n_giro = isset($_POST["n_giro"])? limpiarCadena($_POST["n_giro"]):"";
$d_giro = isset($_POST["d_giro"])? limpiarCadena($_POST["d_giro"]):"";
$c_giro = isset($_POST["c_giro"])? limpiarCadena($_POST["c_giro"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($idgiro)) {
		$rspta=$giro->insertar($n_giro,$d_giro,$c_giro);
		echo $rspta ? "Giro registrado" : "Giro no se pudo registrar";
	}
	else {
		$rspta=$giro->editar($idgiro,$n_giro,$d_giro,$c_giro);
		echo $rspta ? "Giro actualizado" : "Giro no se pudo actualizar";
	}
	break;
	
	case 'mostrar':
	$rspta=$giro->mostrar($idgiro);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$giro->eliminar($idgiro);
	echo $rspta ? "Giro eliminado" : "El giro no se puede eliminar";
	break;
	
	case 'listar':
	$rspta=$giro->listar();
		//Declarrar array
	$data= Array();
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->idgiro,
			"1"=>$reg->n_giro,
			"2"=>$reg->d_giro,
			"3"=>$reg->c_giro,
			"4"=>'<button class="btn btn-primary" onclick="mostrarGiro('.$reg->idgiro.')"><i class="fa fa-pencil"></i></button>',
			"5"=>'<button class="btn btn-danger" onclick="eliminarGiro('.$reg->idgiro.')"><i class="fa fa-trash"></i></button>'
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