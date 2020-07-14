<?php
session_start();
require_once "../modelos/Dias_Horario.php";

$horarios = new Dias_Horario();

$iddias_horario = isset($_POST["iddias_horario"])? limpiarCadena($_POST["iddias_horario"]):"";
$idinfo_negocio = isset($_POST["idinfo_negocio"])? limpiarCadena($_POST["idinfo_negocio"]):"";
$he_lun = isset($_POST["he_lun"])? limpiarCadena($_POST["he_lun"]):"";
$hc_lun = isset($_POST["hc_lun"])? limpiarCadena($_POST["hc_lun"]):"";
$hs_lun = isset($_POST["hs_lun"])? limpiarCadena($_POST["hs_lun"]):"";
$he_mar = isset($_POST["he_mar"])? limpiarCadena($_POST["he_mar"]):"";
$hc_mar = isset($_POST["hc_mar"])? limpiarCadena($_POST["hc_mar"]):"";
$hs_mar = isset($_POST["hs_mar"])? limpiarCadena($_POST["hs_mar"]):"";
$he_mie = isset($_POST["he_mie"])? limpiarCadena($_POST["he_mie"]):"";
$hc_mie = isset($_POST["hc_mie"])? limpiarCadena($_POST["hc_mie"]):"";
$hs_mie = isset($_POST["hs_mie"])? limpiarCadena($_POST["hs_mie"]):"";
$he_jue = isset($_POST["he_jue"])? limpiarCadena($_POST["he_jue"]):"";
$hc_jue = isset($_POST["hc_jue"])? limpiarCadena($_POST["hc_jue"]):"";
$hs_jue = isset($_POST["hs_jue"])? limpiarCadena($_POST["hs_jue"]):"";
$he_vie = isset($_POST["he_vie"])? limpiarCadena($_POST["he_vie"]):"";
$hc_vie = isset($_POST["hc_vie"])? limpiarCadena($_POST["hc_vie"]):"";
$hs_vie = isset($_POST["hs_vie"])? limpiarCadena($_POST["hs_vie"]):"";
$he_sab = isset($_POST["he_sab"])? limpiarCadena($_POST["he_sab"]):"";
$hc_sab = isset($_POST["hc_sab"])? limpiarCadena($_POST["hc_sab"]):"";
$hs_sab = isset($_POST["hs_sab"])? limpiarCadena($_POST["hs_sab"]):"";
$he_dom = isset($_POST["he_dom"])? limpiarCadena($_POST["he_dom"]):"";
$hc_dom = isset($_POST["hc_dom"])? limpiarCadena($_POST["hc_dom"]):"";
$hs_dom = isset($_POST["hs_dom"])? limpiarCadena($_POST["hs_dom"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

	$rspta=$horarios->editarD($iddias_horario, $he_lun, $hc_lun, $hs_lun, $he_mar, $hc_mar, $hs_mar, $he_mie, $hc_mie, $hs_mie, $he_jue, $hc_jue, $hs_jue, $he_vie, $hc_vie, $hs_vie, $he_sab, $hc_sab, $hs_sab, $he_dom, $hc_dom, $hs_dom);
	echo $rspta ? "La información se actualizó" : "La información no se pudo actualizar";
	
	break;
	
	case 'mostrar':
	$rspta=$horarios->mostrar($idinfo_negocio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;
	
}

?>