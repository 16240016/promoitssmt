<?php
session_start();
require_once "../modelos/Redes_Sociales.php";

$redes_sociales = new Redes_Sociales();

$idredes_sociales = isset($_POST["idredes_sociales"])? limpiarCadena($_POST["idredes_sociales"]):"";
$idinfo_negocio = isset($_POST["idinfo_negocio"])? limpiarCadena($_POST["idinfo_negocio"]):"";
$correo_n = isset($_POST["correo_n"])? limpiarCadena($_POST["correo_n"]):"";
$num_local = isset($_POST["num_local"])? limpiarCadena($_POST["num_local"]):"";
$num_whats = isset($_POST["num_whats"])? limpiarCadena($_POST["num_whats"]):"";
$dir_face = isset($_POST["dir_face"])? limpiarCadena($_POST["dir_face"]):"";
$dir_twiter = isset($_POST["dir_twiter"])? limpiarCadena($_POST["dir_twiter"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($idredes_sociales)) {
		$rspta=$redes_sociales->insertar($correo_n, $num_local, $num_whats, $dir_face, $dir_twiter);
		echo $rspta ? "Redes sociales registradas" : "Las redes sociales no se pudieron registrar";
	}
	else {
		$rspta=$redes_sociales->editar($idredes_sociales, $correo_n, $num_local, $num_whats, $dir_face, $dir_twiter);
		echo $rspta ? "Redes sociales actualizadas" : "Las redes sociales no se pudieron actualizar";
	}
	break;
	
	case 'mostrar':
	$rspta=$redes_sociales->mostrar($idinfo_negocio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$redes_sociales->eliminar($idredes_sociales);
	echo $rspta ? "dirección eliminada" : "La dirección no se puede eliminar";
	break;	
}

?>