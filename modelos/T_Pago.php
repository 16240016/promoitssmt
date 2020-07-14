<?php
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class T_Pago
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación de metodo para listar los dias
	public function listar()
	{
		$sql="SELECT * FROM t_pago";
		return ejecutarConsulta($sql);
	}
}

?>