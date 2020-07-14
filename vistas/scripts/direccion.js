var id;

//Función que se ejecuta al inicio
function init()
{

	id=$('input[name=negocio2]').val();
	mostrarD(id);

	$("#formDatosNDireccion").on("submit", function(e)
	{
		guardaryeditarD(e);
	})

	//Se cargan los codigos postales al select
	$.post("../ajax/direccion.php?op=selectLocalidad&negocio="+id, function(r) {
		$("#idlocalidad").html(r);
		//$("#idlocalidad").selectpicker('refresh');
	})
}


//Función para guardar y editar
function guardaryeditarD(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarD").prop("disabled",true);
	var  formData = new FormData($("#formDatosNDireccion")[0]);
	
	$.ajax({
		url: "../ajax/direccion.php?op=guardaryeditar",
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
function mostrarD(idinfo_negocio)
{
	$.post("../ajax/direccion.php?op=mostrar", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		
		$("#idinfo_negocio").val(data.idneg);
		$("#idlocalidad").val(data.idloc);
		$("#calle").val(data.cal);
		$("#numero").val(data.num);
		$("#estado").val(data.est);
		$("#municipio").val(data.mun);
		$("#iddireccion").val(data.iddir);
	});	
}

init();