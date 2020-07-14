<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Servicios
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($idinfo_negocio, $n_servicio, $d_servicio)
	{
		$sql="INSERT INTO servicios (idinfo_negocio, n_servicio, d_servicio) VALUES('$idinfo_negocio', '$n_servicio', '$d_servicio')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idservicio, $n_servicio, $d_servicio)
	{
		$sql="UPDATE servicios SET n_servicio='$n_servicio', d_servicio='$d_servicio' WHERE idservicio='$idservicio'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un giro
	public function eliminar($idservicio)
	{
		$sql="DELETE FROM servicios WHERE idservicio='$idservicio'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idservicio)
	{
		$sql="SELECT * FROM servicios WHERE idservicio='$idservicio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar($idinfo_negocio)
	{
		$sql="SELECT * FROM servicios WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}
	
}

?>