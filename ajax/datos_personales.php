<?php
session_start();
require_once "../modelos/Datos_Personales.php";

$datos_personales = new Datos_Personales();

$idpersonal = isset($_POST["idpersonal"])? limpiarCadena($_POST["idpersonal"]):"";
$nombres = isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
$a_paterno = isset($_POST["a_paterno"])? limpiarCadena($_POST["a_paterno"]):"";
$a_materno = isset($_POST["a_materno"])? limpiarCadena($_POST["a_materno"]):"";
$rfc_usuario = isset($_POST["rfc_usuario"])? limpiarCadena($_POST["rfc_usuario"]):"";
$n_telefono = isset($_POST["n_telefono"])? limpiarCadena($_POST["n_telefono"]):"";
$correo_usu = isset($_POST["correo_usu"])? limpiarCadena($_POST["correo_usu"]):"";
$c_usuario = isset($_POST["c_usuario"])? limpiarCadena($_POST["c_usuario"]):"";
$n_usuario = isset($_POST["n_usuario"])? limpiarCadena($_POST["n_usuario"]):"";
$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	 if (empty($idpersonal)) {
		$rspta=$datos_personales->insertar($nombres, $a_paterno, $a_materno, $rfc_usuario, $n_telefono, $correo_usu, $c_usuario, $n_usuario, $idusuario);
		echo $rspta ? "Datos registrados" : "Los datos no se pudieron registrar";
	}
	else {
		$rspta=$datos_personales->editar($idpersonal, $nombres, $a_paterno, $a_materno, $rfc_usuario, $n_telefono, $correo_usu, $n_usuario, $c_usuario, $idusuario);
		echo $rspta ? "Datos actualizados" : "Los datos no se pudieron actualizar";
	}
	break;
	
	case 'mostrar':
	$rspta=$datos_personales->mostrar($idpersonal);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$datos_personales->eliminar($idpersonal);
	echo $rspta ? "Datos eliminados" : "Los datos no se pueden eliminar";
	break;
	
	case 'listar':
	$rspta=$datos_personales->listar();
		//Declarrar array
	$data= Array();
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->idpersonal,
			"1"=>$reg->nombres,
			"2"=>$reg->a_paterno,
			"3"=>$reg->a_materno,
			"4"=>$reg->rfc_usuario,
			"5"=>$reg->n_telefono,
			"6"=>$reg->correo_usu,
			"7"=>'<button class="btn btn-primary" onclick="moostrar('.$reg->idpersonal.')"><i class="fa fa-pencil"></i></button>',
			"8"=>'<button class="btn btn-danger" onclick="eliminar('.$reg->idpersonal.')"><i class="fa fa-trash"></i></button>'
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