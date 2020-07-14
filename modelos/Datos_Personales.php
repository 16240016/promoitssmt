<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Datos_Personales
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($nombres, $a_paterno, $a_materno, $rfc_usuario, $n_telefono, $correo_usu, $n_usuario, $c_usuario, $idusuario)
	{
		$sql="INSERT INTO datos_personales (nombres, a_paterno, a_materno, rfc_usuario, n_telefono, correo_usu) VALUES('$nombres', '$a_paterno', '$a_materno', '$rfc_usuario', '$n_telefono', '$correo_usu')";
		return ejecutarConsulta($sql);

		$sql="UPDATE usuarios SET c_usuario='$c_usuario', n_usuario='$n_usuario' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idpersonal, $nombres, $a_paterno, $a_materno, $rfc_usuario, $n_telefono, $correo_usu, $n_usuario, $c_usuario, $idusuario)
	{
		$sql="UPDATE datos_personales SET nombres='$nombres', a_paterno='$a_paterno', a_materno='$a_materno', rfc_usuario='$rfc_usuario', n_telefono='$n_telefono', correo_usu='$correo_usu' WHERE idpersonal='$idpersonal'";
		ejecutarConsulta($sql);

		$sql="UPDATE usuarios SET c_usuario='$c_usuario', n_usuario='$n_usuario' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un usuario
	public function eliminar($idpersonal)
	{
		$sql="DELETE FROM datos_personales WHERE idpersonal='$idpersonal'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idpersonal)
	{
		$sql="SELECT d.idpersonal AS idp, u.idusuario AS idu, d.nombres AS nombres, d.a_paterno AS a_paterno, d.a_materno AS a_materno, d.rfc_usuario AS rfc_usuario, d.n_telefono AS n_telefono, d.correo_usu AS correo_usu, u.n_usuario AS n_usuario, u.c_usuario AS c_usuario FROM datos_personales AS d JOIN usuarios AS u ON d.idusuario=u.idusuario WHERE idpersonal='$idpersonal'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar()
	{
		$sql="SELECT idpersonal, nombres, a_paterno, a_materno, rfc_usuario, n_telefono, correo_usu FROM datos_personales";
		return ejecutarConsulta($sql);
	}
	
}

?>