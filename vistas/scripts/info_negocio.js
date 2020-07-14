var id;

//Función que se ejecuta al inicio
function init()
{
	//Se obtiene el idpersonal de una variable de sesión de input hidden id
	id=$('input[name=negocio]').val();
	mostrarIN(id);
	tipo(id);
	
	
	$("#formDatosNInformacion").on("submit", function(e)
	{
		guardaryeditarIN(e);
	})

	//Se cargan los giros al select
	$.post("../ajax/info_negocio.php?op=selectGiro&negocio="+id, function(r) {
		$("#idgiro").html(r);
		//$("#idgiro").selectpicker('refresh');
	})

}


//Función para guardar y editar
function guardaryeditarIN(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarIN").prop("disabled",true);
	var  formData = new FormData($("#formDatosNInformacion")[0]);
	
	$.ajax({
		url: "../ajax/info_negocio.php?op=guardaryeditar",
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


function mostrarIN(idinfo_negocio)
{
	$.post("../ajax/info_negocio.php?op=mostrar", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		$("#idpersonal2").val(data.idpersonal);
		$("#idgiro").val(data.idgiro);
		$("#n_negocio").val(data.n_negocio);
		$("#ref_negocio").val(data.ref_negocio);
		$("#rfc_negocio").val(data.rfc_negocio);
		$("#imagenmuestra1").show();
		$("#imagenmuestra1").attr("src", "../files/img_negocios_carousel/"+data.url_imagen1);
		$("#imagenactual1").val(data.url_imagen1);
		$("#imagenmuestra2").show();
		$("#imagenmuestra2").attr("src", "../files/img_negocios_tarjetas/"+data.url_imagen2);
		$("#imagenactual2").val(data.url_imagen2);
		$("#tipo_negocio").val(data.tipo_negocio);
		$("#tipo_servicio").val(data.tipo_servicio);
		$("#idinfo_negocio").val(data.idinfo_negocio);
	});	
}

//Función para eliminar un usuario
function eliminarIN(idpersonal)
{
	bootbox.confirm("¿Estas seguro de eliminar la información de este negocio?", function(result) {
		if (result) {
			$.post("../ajax/info_negocio.php?op=eliminar", {idpersonal : idpersonal}, function(e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function tipo(idinfo_negocio)
{
	$.post("../ajax/info_negocio.php?op=obtenerTipo", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		//Mostrar pestaña de productos o servicios
		$.post("../ajax/info_negocio.php?op=elegirTipo&tipo="+ data.tipo_negocio, function(h) {
			$("#tipo_bd").html(h);
		
		})	
	});

}

init();