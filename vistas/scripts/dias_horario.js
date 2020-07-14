var id;

//Función que se ejecuta al inicio
function init()
{
	//Se obtiene el idpersonal de una variable de sesión de input hidden id
	id=$('input[name=negocio2]').val();
	mostrarHor(id);
	
	$("#formDatosNHorario").on("submit", function(e)
	{
		guardaryeditarHor(e);
	})

	//Se cargan los giros pagos seleccionados
	$.post("../ajax/info_negocio.php?op=pagos&id="+ id, function(r) {
		$("#t_pagos").html(r);
	})

}


//Función para guardar y editar
function guardaryeditarHor(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarHor").prop("disabled",true);
	var  formData = new FormData($("#formDatosNHorario")[0]);
	
	$.ajax({
		url: "../ajax/dias_horario.php?op=guardaryeditar",
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


function mostrarHor(idinfo_negocio)
{
	$.post("../ajax/dias_horario.php?op=mostrar", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		$("#he_lun").val(data.he_lun);
		$("#hc_lun").val(data.hc_lun);
		$("#hs_lun").val(data.hs_lun);
		$("#he_mar").val(data.he_mar);
		$("#hc_mar").val(data.hc_mar);
		$("#hs_mar").val(data.hs_mar);
		$("#he_mie").val(data.he_mie);
		$("#hc_mie").val(data.hc_mie);
		$("#hs_mie").val(data.hs_mie);
		$("#he_jue").val(data.he_jue);
		$("#hc_jue").val(data.hc_jue);
		$("#hs_jue").val(data.hs_jue);
		$("#he_vie").val(data.he_vie);
		$("#hc_vie").val(data.hc_vie);
		$("#hs_vie").val(data.hs_vie);
		$("#he_sab").val(data.he_sab);
		$("#hc_sab").val(data.hc_sab);
		$("#hs_sab").val(data.hs_sab);
		$("#he_dom").val(data.he_dom);
		$("#hc_dom").val(data.hc_dom);
		$("#hs_dom").val(data.hs_dom);
		$("#idinfo_negocio4").val(data.idinfo_negocio);
		$("#iddias_horario").val(data.iddias_horario);
	});	
}


init();