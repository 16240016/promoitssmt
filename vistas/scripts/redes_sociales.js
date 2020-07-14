var id;

//Función que se ejecuta al inicio
function init()
{

	id=$('input[name=negocio2]').val();
	mostrarRS(id);

	$("#formDatosNRedes").on("submit", function(e)
	{
		guardaryeditarRS(e);
	})

}


//Función para guardar y editar
function guardaryeditarRS(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarRS").prop("disabled",true);
	var  formData = new FormData($("#formDatosNRedes")[0]);
	
	$.ajax({
		url: "../ajax/redes_sociales.php?op=guardaryeditar",
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
function mostrarRS(idinfo_negocio)
{
	$.post("../ajax/redes_sociales.php?op=mostrar", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		$("#idinfo_negocio").val(data.idinfo_negocio);
		$("#correo_n").val(data.correo_n);
		$("#num_local").val(data.num_local);
		$("#num_whats").val(data.num_whats);
		$("#dir_face").val(data.dir_face);
		$("#dir_twiter").val(data.dir_twiter);
		$("#idredes_sociales").val(data.idredes_sociales);
	});	
}

init();