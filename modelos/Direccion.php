<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Direccion
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($idlocalidad, $idinfo_negocio, $calle, $numero, $estado, $municipio)
	{
		$sql="INSERT INTO direccion (idlocalidad, calle, numero, estado, municipio) VALUES('$idlocalidad', '$calle', '$numero', '$estado', '$municipio')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($iddireccion, $idlocalidad, $idinfo_negocio, $calle, $numero, $estado, $municipio)
	{
		$sql="UPDATE direccion SET idlocalidad='$idlocalidad', calle='$calle', numero='$numero', estado='$estado', municipio='$municipio' WHERE iddireccion='$iddireccion'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un giro
	public function eliminar($iddireccion)
	{
		$sql="DELETE FROM direccion WHERE iddireccion='$iddireccion'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idinfo_negocio)
	{
		$sql="SELECT iddireccion AS iddir, idinfo_negocio AS idneg, idlocalidad AS idloc, calle AS cal, numero AS num, estado AS est, municipio AS mun FROM direccion WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para obtener el id del codigo postal seleccionado
	public function selectL($idinfo_negocio)
	{
		$sql="SELECT idlocalidad FROM direccion WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

}

?>