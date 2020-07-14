var tabla;

//Función que se ejecuta al inicio
function init()
{
	listar();
	
	$("#formEditGiro").on("submit", function(e)
	{
		guardaryeditarG(e);
	})
}

//Listar los giros en la tabla tblistado
function listar()
{
	tabla=$('#tbllistadoGiro').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/giro.php?op=listar',
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
function guardaryeditarG(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarGiro").prop("disabled",true);
	var  formData = new FormData($("#formEditGiro")[0]);
	
	$.ajax({
		url: "../ajax/giro.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			mostrarformGiros(false);
			tabla.ajax.reload();
		}	
		
	});
	limpiar();
}

//Función para llenar los campos del formulario del modal Editar Giro
function mostrarGiro(idgiro)
{
	$.post("../ajax/giro.php?op=mostrar", {idgiro : idgiro}, function(data, status)
	{
		data = JSON.parse(data);
		$("#btnagregarGiro").trigger("click");
		
		$("#n_giro").val(data.n_giro);
		$("#d_giro").val(data.d_giro);
		$("#c_giro").val(data.c_giro);
		$("#idgiro").val(data.idgiro);
	});	
} 

//Función para eliminar un giro
function eliminarGiro(idgiro)
{
	bootbox.confirm("¿Estas seguro de eliminar este giro?", function(result) {
		if (result) {
			$.post("../ajax/giro.php?op=eliminar", {idgiro : idgiro}, function(e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Funcion limpiar
function limpiar()
{
	$("#idgiro").val("");
	$("#n_giro").val("");
	$("#d_giro").val("");
	$("#c_giro").val("");
}

init();