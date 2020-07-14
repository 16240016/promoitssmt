<?php
session_start();
require_once "../modelos/Direccion.php";

$direccion = new Direccion();

$iddireccion = isset($_POST["iddireccion"])? limpiarCadena($_POST["iddireccion"]):"";
$idlocalidad = isset($_POST["idlocalidad"])? limpiarCadena($_POST["idlocalidad"]):"";
$idinfo_negocio = isset($_POST["idinfo_negocio"])? limpiarCadena($_POST["idinfo_negocio"]):"";
$calle = isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$numero = isset($_POST["numero"])? limpiarCadena($_POST["numero"]):"";
$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$municipio = isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($iddireccion)) {
		$rspta=$direccion->insertar($idlocalidad, $idinfo_negocio, $calle, $numero, $estado, $municipio);
		echo $rspta ? "dirección registrada" : "La dirección no se pudo registrar";
	}
	else {
		$rspta=$direccion->editar($iddireccion, $idlocalidad, $idinfo_negocio, $calle, $numero, $estado, $municipio);
		echo $rspta ? "dirección actualizada" : "La dirección no se pudo actualizar";
	}
	break;
	
	case 'mostrar':
	$rspta=$direccion->mostrar($idinfo_negocio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$direccion->eliminar($iddireccion);
	echo $rspta ? "dirección eliminada" : "La dirección no se puede eliminar";
	break;

	case 'selectLocalidad':

	require_once "../modelos/Localidad.php";
	$localidad = new Localidad();

	$id = $_GET['negocio'];

	$select = $direccion->selectL($id);

	$vector = array();

	while($local = $select->fetch_object())
	{
		array_push($vector, $local->idlocalidad);
	}

	$rspta = $localidad->listar();

	while ($reg = $rspta->fetch_object())
	{
		$sw=in_array($reg->idlocalidad, $vector)?'selected="true"' :'';
		echo '<option value='. $reg->idlocalidad . ' '.$sw.'>' . $reg->codigo_p . ' - ' . $reg->n_localidad . '</option>';
	}
	break;
	
}

?>