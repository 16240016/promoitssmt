<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Giro
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($n_giro, $d_giro, $c_giro)
	{
		$sql="INSERT INTO giro (n_giro, d_giro, c_giro) VALUES('$n_giro', '$d_giro', '$c_giro')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idgiro, $n_giro, $d_giro, $c_giro)
	{
		$sql="UPDATE giro SET n_giro='$n_giro', d_giro='$d_giro', c_giro='$c_giro' WHERE idgiro='$idgiro'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un giro
	public function eliminar($idgiro)
	{
		$sql="DELETE FROM giro WHERE idgiro='$idgiro'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idgiro)
	{
		$sql="SELECT * FROM giro WHERE idgiro='$idgiro'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM giro";
		return ejecutarConsulta($sql);
	}
	
}

?>