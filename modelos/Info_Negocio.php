<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Info_Negocio
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implemetación de metodo para editar registros
	public function editar($idinfo_negocio, $idpersonal, $idgiro, $n_negocio, $ref_negocio, $rfc_negocio, $url_imagen1, $url_imagen2, $tipo_negocio, $tipo_servicio, $pago)
	{
		$sql="UPDATE info_negocio SET idgiro='$idgiro', n_negocio='$n_negocio', ref_negocio='$ref_negocio', rfc_negocio='$rfc_negocio', url_imagen1='$url_imagen1', url_imagen2='$url_imagen2', tipo_negocio='$tipo_negocio', tipo_servicio='$tipo_servicio' WHERE idpersonal='$idpersonal' AND idinfo_negocio='$idinfo_negocio'";
		ejecutarConsulta($sql);

		$sqldel="DELETE FROM negocio_pago WHERE idinfo_negocio='$idinfo_negocio'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;
		
		while ($num_elementos < count($pago)) {
			$sql_detalle = "INSERT INTO negocio_pago(idpago, idinfo_negocio) VALUES('$pago[$num_elementos]', '$idinfo_negocio')";
			ejecutarConsulta($sql_detalle) or $sw=false;
			$num_elementos=$num_elementos + 1;
		}
		return $sw;

	}

	//Implementación de metodo para eliminar a un usuario
	public function eliminar($idinfo_negocio)
	{
		$sql="DELETE FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idinfo_negocio)
	{
		$sql="SELECT * FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar()
	{
		$sql="SELECT i.idinfo_negocio AS idinfo_negocio, i.n_negocio AS n_negocio, i.ref_negocio AS ref_negocio, i.rfc_negocio AS rfc_negocio, i.url_imagen1 AS url_imagen1, i.url_imagen2 AS url_imagen2, i.tipo_negocio AS tipo_negocio, g.n_giro as n_giro FROM info_negocio AS i LEFT JOIN giro AS g ON i.idgiro=g.idgiro";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para seleccionar giro
	public function selectG($idinfo_negocio)
	{
		$sql="SELECT idgiro FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para determinar pestaña de servicios o productos
	public function tipo($idinfo_negocio)
	{
		$sql="SELECT tipo_negocio FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

		//Implementar un metodo para listar los tipos de pago marcados
	public function listarpagos($idinfo_negocio)
	{
		$sql="SELECT * FROM negocio_pago WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un metodo para obtener las imagenes para el carousel
	public function carousel(){
		$sql="SELECT url_imagen1, n_negocio, ref_negocio FROM info_negocio WHERE url_imagen1!='prueba' ORDER BY RAND() LIMIT 10";
		return ejecutarConsulta($sql);
	}

	//Implementar un metodo para obtener toda la información de las tarjetas de negocios
	public function tarjetas($giro){
		$sql="SELECT i.idinfo_negocio AS id, i.n_negocio AS n_negocio, i.url_imagen2 AS url_imagen2, i.ref_negocio AS ref_negocio, CONCAT('Calle ',d.calle,' #',d.numero,', Col. ',l.n_localidad,', C.P. ',l.codigo_p,', ',d.municipio,', ',d.estado) AS direccion, rs.num_local AS num_local, CONCAT(h.he_lun,' - ',h.hs_lun) AS lunes, CONCAT(h.he_mar,' - ',h.hs_mar) AS martes, CONCAT(h.he_mie,' - ',h.hs_mie) AS miercoles, CONCAT(h.he_jue,' - ',h.hs_jue) AS jueves, CONCAT(h.he_vie,' - ',h.hs_vie) AS viernes, CONCAT(h.he_sab,' - ',h.hs_sab) AS sabado, CONCAT(h.he_dom,' - ',h.hs_dom) AS domingo, i.tipo_servicio AS tipo_servicio, rs.correo_n AS correo_n, rs.num_whats AS num_whats, rs.dir_face AS dir_face, rs.dir_twiter AS dir_twiter FROM localidad AS l JOIN direccion AS d ON l.idlocalidad=d.idlocalidad JOIN info_negocio AS i ON d.idinfo_negocio=i.idinfo_negocio JOIN redes_sociales AS rs ON i.idinfo_negocio=rs.idinfo_negocio JOIN dias_horario AS h ON rs.idinfo_negocio=h.idinfo_negocio WHERE i.idgiro='$giro'";
		return ejecutarConsulta($sql);
	}

		//Implementar un metodo para listar los tipos de pago marcados por el usuario en tarjetas
	public function listarpagosTarjetas($idinfo_negocio)
	{
		$sql="SELECT t.tipo_pago AS nombre_pago FROM t_pago AS t JOIN negocio_pago AS np ON t.idpago=np.idpago WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

}

?>