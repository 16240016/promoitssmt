<?php
session_start();
require_once "../modelos/Productos.php";

$productos = new Productos();

$idproductos = isset($_POST["idproductos"])? limpiarCadena($_POST["idproductos"]):"";
$idinfo_negocio = isset($_POST["idinfo_negocio2"])? limpiarCadena($_POST["idinfo_negocio2"]):"";
$n_producto = isset($_POST["n_producto"])? limpiarCadena($_POST["n_producto"]):"";
$m_producto = isset($_POST["m_producto"])? limpiarCadena($_POST["m_producto"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($idproductos)) {
		$rspta=$productos->insertar($idinfo_negocio, $n_producto,$m_producto);
		echo $rspta ? "producto registrado" : "El producto no se pudo registrar";
	}
	else {
		$rspta=$productos->editar($idproductos, $n_producto, $m_producto);
		echo $rspta ? "Producto actualizado" : "eL producto no se pudo actualizar";
	}
	break;
	
	case 'mostrar':
	$rspta=$productos->mostrar($idproductos);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$productos->eliminar($idproductos);
	echo $rspta ? "Producto eliminado" : "El producto no se puede eliminar";
	break;
	
	case 'listar':
	$idinfo_negocio=$_GET['id'];
	$rspta=$productos->listar($idinfo_negocio);
		//Declarrar array
	$data= Array();
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->idproductos,
			"1"=>$reg->n_producto,
			"2"=>$reg->m_producto,
			"3"=>'<button class="btn btn-primary" onclick="mostrarPro('.$reg->idproductos.')"><i class="fa fa-pencil"></i></button>',
			"4"=>'<button class="btn btn-danger" onclick="eliminarPro('.$reg->idproductos.')"><i class="fa fa-trash"></i></button>'
		);
	}
	$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data),//enviamos el totoal de registros al datatables
			"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
			"aaData"=>$data);
	echo json_encode($results);
	break;

	case 'busquedaInsumos':
	$rspta=$productos->busquedaInsumos();
		//Declarrar array
	$data= Array();
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->nombre,
			"1"=>$reg->descripcion,
			"2"=>$reg->negocio,
			"3"=>$reg->direccion,
			"4"=>$reg->telefono,
			"5"=>$reg->lunes,
			"6"=>$reg->martes,
			"7"=>$reg->miercoles,
			"8"=>$reg->jueves,
			"9"=>$reg->viernes,
			"10"=>$reg->sabado,
			"11"=>$reg->domingo
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