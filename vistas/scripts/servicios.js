var tablaSer;
var id;

//Función que se ejecuta al inicio
function init()
{
	id=$('input[name=negocio2]').val();
	listarSer(id);
	
	$("#formDatosNServicios").on("submit", function(e)
	{
		guardaryeditarSer(e);
	})

}

//Listar los productos en la tabla tblistadoProductos
function listarSer(idinfo_negocio)
{
	tablaSer=$('#tbllistadoServicios').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/servicios.php?op=listar&id='+id,
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 9, //Paginación
		"order": [[ 0, "desc" ]] //Ordenar (columa, orden)	
	}).DataTable();
}

//Función para guardar y editar
function guardaryeditarSer(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarSer").prop("disabled",true);
	var  formData = new FormData($("#formDatosNServicios")[0]);
	
	$.ajax({
		url: "../ajax/servicios.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			//bootbox.alert(datos);
			tablaSer.ajax.reload();
		}	
		
	});
	limpiarPro();
}

//Función para llenar los campos del formulario del modal Editar Giro
function mostrarSer(idservicio)
{
	$.post("../ajax/servicios.php?op=mostrar", {idservicio : idservicio}, function(data, status)
	{
		data = JSON.parse(data);
		$("#btnagregarSer").trigger("click");
		
		$("#idinfo_negocio3").val(data.idinfo_negocio);
		$("#n_servicio").val(data.n_servicio);
		$("#d_servicio").val(data.d_servicio);
		$("#idservicio").val(data.idservicio);
	});	
} 

//Función para eliminar un giro
function eliminarSer(idservicio)
{
	bootbox.confirm("¿Estas seguro de eliminar este servicio?", function(result) {
		if (result) {
			$.post("../ajax/servicios.php?op=eliminar", {idservicio : idservicio}, function(e) {
				bootbox.alert(e);
				tablaSer.ajax.reload();
			});
		}
	})
}

//Funcion limpiar
function limpiarSer()
{
	$("#n_servicio").val("");
	$("#d_servicio").val("");
	$("#idservicio").val("");
}

init();