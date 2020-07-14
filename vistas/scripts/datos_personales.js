var tabla;
var id;

//Función que se ejecuta al inicio
function init()
{
	//Se obtiene el idpersonal de una variable de sesión de input hidden id
	id=$('input[name=id]').val();
	mostrarDP(id);
	
	$("#formDatosPer").on("submit", function(e)
	{
		guardaryeditarDP(e);
	})
}


//Función para guardar y editar
function guardaryeditarDP(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarDP").prop("disabled",true);
	var  formData = new FormData($("#formDatosPer")[0]);
	
	$.ajax({
		url: "../ajax/datos_personales.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
		}	
		
	});
}

//Función para llenar los campos del formulario del modal Editar Usuario
function mostrarDP(idpersonal)
{
	$.post("../ajax/datos_personales.php?op=mostrar", {idpersonal : idpersonal}, function(data, status)
	{
		data = JSON.parse(data);

		$("#nombres").val(data.nombres);
		$("#a_paterno").val(data.a_paterno);
		$("#a_materno").val(data.a_materno);
		$("#rfc_usuario").val(data.rfc_usuario);
		$("#n_telefono").val(data.n_telefono);
		$("#correo_usu").val(data.correo_usu);
		$("#n_usuario").val(data.n_usuario);
		$("#c_usuario").val(data.c_usuario);
		$("#idusuario").val(data.idu);
		$("#idpersonal").val(data.idp);
	});	
}

//Función para eliminar un usuario
function eliminar(idpersonal)
{
	bootbox.confirm("¿Estas seguro de eliminar la información de este usuario?", function(result) {
		if (result) {
			$.post("../ajax/datos_personales.php?op=eliminar", {idpersonal : idpersonal}, function(e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();