<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Localidad
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación de metodo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM localidad";
		return ejecutarConsulta($sql);
	}
	
}

?>