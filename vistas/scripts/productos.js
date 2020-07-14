var tablaPro;
var id;

//Función que se ejecuta al inicio
function init()
{
	id=$('input[name=negocio2]').val();
	listarPro(id);
	
	$("#formDatosNProductos").on("submit", function(e)
	{
		guardaryeditarPro(e);
	})
}

//Listar los productos en la tabla tblistadoProductos
function listarPro(idinfo_negocio)
{
	tablaPro=$('#tbllistadoProductos').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/productos.php?op=listar&id='+id,
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
function guardaryeditarPro(e)
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarPro").prop("disabled",true);
	var  formData = new FormData($("#formDatosNProductos")[0]);
	
	$.ajax({
		url: "../ajax/productos.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			tablaPro.ajax.reload();
		}	
		
	});
	limpiarPro();
}

//Función para llenar los campos del formulario del modal Editar Giro
function mostrarPro(idproductos)
{
	$.post("../ajax/productos.php?op=mostrar", {idproductos : idproductos}, function(data, status)
	{
		data = JSON.parse(data);
		$("#btnagregarPro").trigger("click");
		
		$("#idinfo_negocio2").val(data.idinfo_negocio);
		$("#n_producto").val(data.n_producto);
		$("#m_producto").val(data.m_producto);
		$("#idproductos").val(data.idproductos);
	});	
} 

//Función para eliminar un giro
function eliminarPro(idproductos)
{
	bootbox.confirm("¿Estas seguro de eliminar este producto?", function(result) {
		if (result) {
			$.post("../ajax/productos.php?op=eliminar", {idproductos : idproductos}, function(e) {
				bootbox.alert(e);
				tablaPro.ajax.reload();
			});
		}
	})
}

//Funcion limpiar
function limpiarPro()
{
	$("#n_producto").val("");
	$("#m_producto").val("");
	$("#idproductos").val("");
}

init();