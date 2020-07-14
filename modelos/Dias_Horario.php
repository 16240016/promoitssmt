<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Dias_Horario
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implemetación de metodo para editar registros de dias_horario
	public function editarD($iddias_horario, $he_lun, $hc_lun, $hs_lun, $he_mar, $hc_mar, $hs_mar, $he_mie, $hc_mie, $hs_mie, $he_jue, $hc_jue, $hs_jue, $he_vie, $hc_vie, $hs_vie, $he_sab, $hc_sab, $hs_sab, $he_dom, $hc_dom, $hs_dom)
	{
		$sqlD="UPDATE dias_horario SET he_lun='$he_lun', hc_lun='$hc_lun', hs_lun='$hs_lun', he_mar='$he_mar', hc_mar='$hc_mar', hs_mar='$hs_mar', he_mie='$he_mie', hc_mie='$hc_mie', hs_mie='$hs_mie', he_jue='$he_jue', hc_jue='$hc_jue', hs_jue='$hs_jue', he_vie='$he_vie', hc_vie='$hc_vie', hs_vie='$hs_vie', he_sab='$he_sab', hc_sab='$hc_sab', hs_sab='$hs_sab', he_dom='$he_dom', hc_dom='$hc_dom', hs_dom='$hs_dom' WHERE iddias_horario='$iddias_horario'";
		ejecutarConsulta($sqlD);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idinfo_negocio)
	{
		$sql="SELECT * FROM dias_horario WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}
		
}

?>