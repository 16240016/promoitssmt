<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuarios
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($n_usuario, $c_usuario)
	{
		$sql="INSERT INTO usuarios (n_usuario, c_usuario, estado) VALUES('$n_usuario', '$c_usuario', 'activo')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idusuario, $n_usuario, $c_usuario)
	{
		$sql="UPDATE usuarios SET n_usuario='$n_usuario', c_usuario='$c_usuario' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un usuario
	public function eliminar($idusuario)
	{
		$sql="DELETE FROM usuarios WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para desactivar a un usuario
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuarios SET estado='inactivo' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para activar a un usuario
	public function activar($idusuario)
	{
		$sql="UPDATE usuarios SET estado='activo' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuarios WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuarios";
		return ejecutarConsulta($sql);
	}
	
	//Verificar el acceso al sistema
	public function verificar($login, $clave)
	{
		$sql="SELECT u.idusuario AS idusuario, u.n_usuario AS n_usuario, CONCAT(d.nombres,' ', d.a_paterno) AS nombre, d.idpersonal AS idpersonal, i.idinfo_negocio AS idinfo_negocio, i.tipo_negocio AS tipo_negocio FROM usuarios AS u LEFT JOIN datos_personales AS d ON u.idusuario=d.idusuario LEFT JOIN info_negocio AS i ON d.idpersonal=i.idpersonal WHERE n_usuario='$login' AND c_usuario='$clave' AND estado='activo'";
		return ejecutarConsulta($sql);
	}
}

?>