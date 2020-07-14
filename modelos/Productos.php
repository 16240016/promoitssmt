<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Productos
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($idinfo_negocio, $n_producto, $m_producto)
	{
		$sql="INSERT INTO productos (idinfo_negocio, n_producto, m_producto) VALUES('$idinfo_negocio', '$n_producto', '$m_producto')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idproductos, $n_producto, $m_producto)
	{
		$sql="UPDATE productos SET n_producto='$n_producto', m_producto='$m_producto' WHERE idproductos='$idproductos'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un giro
	public function eliminar($idproductos)
	{
		$sql="DELETE FROM productos WHERE idproductos='$idproductos'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idproductos)
	{
		$sql="SELECT * FROM productos WHERE idproductos='$idproductos'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar($idinfo_negocio)
	{
		$sql="SELECT * FROM productos WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para listar los registros de tabla productos y servicios
	public function busquedaInsumos()
	{
		$sql="SELECT nombre, descripcion, negocio, direccion, telefono, lunes, martes, miercoles, jueves, viernes, sabado, domingo FROM (
		SELECT p.n_producto AS nombre, p.m_producto AS descripcion, i.n_negocio AS negocio, 
		CONCAT('Calle ',d.calle,' #',d.numero,', Col. ',l.n_localidad,', C.P. ',l.codigo_p,', ',d.municipio,', ',d.estado) AS direccion, 
		r.num_local AS telefono,
		CONCAT(h.he_lun,' - ',h.hs_lun) AS lunes,
		CONCAT(h.he_mar,' - ',h.hs_mar) AS martes,
		CONCAT(h.he_mie,' - ',h.hs_mie) AS miercoles,
		CONCAT(h.he_jue,' - ',h.hs_jue) AS jueves,
		CONCAT(h.he_vie,' - ',h.hs_vie) AS viernes,
		CONCAT(h.he_sab,' - ',h.hs_sab) AS sabado,
		CONCAT(h.he_dom,' - ',h.hs_dom) AS domingo
		FROM localidad AS l JOIN direccion AS d ON l.idlocalidad=d.idlocalidad JOIN 
		info_negocio AS i ON d.idinfo_negocio=i.idinfo_negocio JOIN 
		redes_sociales AS r ON i.idinfo_negocio=r.idinfo_negocio JOIN 
		productos AS p ON r.idinfo_negocio=p.idinfo_negocio JOIN
		dias_horario AS h ON p.idinfo_negocio=h.idinfo_negocio

		UNION ALL

		SELECT s.n_servicio AS nombre, s.d_servicio AS descripcion, i.n_negocio AS negocio, 
		CONCAT('Calle ',d.calle,' #',d.numero,', Col. ',l.n_localidad,', C.P. ',l.codigo_p,', ',d.municipio,', ',d.estado) AS direccion, 
		r.num_local AS telefono,
		CONCAT(h.he_lun,' - ',h.hs_lun) AS lunes,
		CONCAT(h.he_mar,' - ',h.hs_mar) AS martes,
		CONCAT(h.he_mie,' - ',h.hs_mie) AS miercoles,
		CONCAT(h.he_jue,' - ',h.hs_jue) AS jueves,
		CONCAT(h.he_vie,' - ',h.hs_vie) AS viernes,
		CONCAT(h.he_sab,' - ',h.hs_sab) AS sabado,
		CONCAT(h.he_dom,' - ',h.hs_dom) AS domingo
		FROM localidad AS l JOIN direccion AS d ON l.idlocalidad=d.idlocalidad JOIN 
		info_negocio AS i ON d.idinfo_negocio=i.idinfo_negocio JOIN 
		redes_sociales AS r ON i.idinfo_negocio=r.idinfo_negocio JOIN 
		servicios AS s ON r.idinfo_negocio=s.idinfo_negocio JOIN
		dias_horario AS h ON s.idinfo_negocio=h.idinfo_negocio
		) cosas ORDER BY nombre";
		return ejecutarConsulta($sql);
	}
	
}

?>