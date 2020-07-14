var id;

//Función que se ejecuta al inicio
function init()
{
	id=$('input[name=negocio]').val();

	$("#formDatosNHorario").on("submit", function(e)
	{
		guardaryeditarHor(e);
	})

	//mostrar horarios
	$.post("../ajax/horarios.php?op=datos&id="+ id, function(r) {
		$("#secDias").html(r);
	})

	//mostrar tipos de pago
	$.post("../ajax/horarios.php?op=pagos&id="+ id, function(t) {
		$("#t_pagos").html(t);
	})
}

//Función para guardar y editar
function guardaryeditarHor(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarHor").prop("disabled",true);
	var  formData = new FormData($("#formDatosNHorario")[0]);
	
	$.ajax({
		url: "../ajax/horarios.php?op=guardaryeditar",
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


init();