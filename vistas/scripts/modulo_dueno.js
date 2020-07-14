var tablaIns;

//Función que se ejecuta al inicio
function init()
{

	listarIns();
	mostrarSeccion1(true);
	mostrarSeccion2(false);
	mostrarSeccion3(false);
	mostrarSeccion4(false);
	mostrarSeccion5(false);
	mostrarSeccion6(false);
	mostrarSeccion7(false);
	mostrarSeccion8(false);
	$("#menuDatosNegocio").hide();
	

	$("nav .nav-link").on("click", function(){
		$("nav").find(".active").removeClass("active");
		$(this).addClass("active");
	});

}

//Formulario de Datos Personales
function mostrarSeccion1(flag)
{
	if(flag){
		$("#seccion1").show();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#menuDatosNegocio").hide();
	} else {
		$("#seccion1").hide();
	}	
}

//Formulario de Información del Negocio
function mostrarSeccion2(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").show();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion2").hide();
	}	
}

//Formulario de Dirección del Negocio
function mostrarSeccion3(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").show();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion3").hide();
	}	
}

//Formulario de Horarios del Negocio
function mostrarSeccion4(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").show();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion4").hide();
	}	
}

//Formulario de Productos del Negocio
function mostrarSeccion5(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").show();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion5").hide();
	}	
}

//Formulario de Productos del Negocio
function mostrarSeccion6(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").show();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion6").hide();
	}	
}

//Formulario de Redes Sociales del Negocio
function mostrarSeccion7(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").show();
		$("#seccion8").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion7").hide();
	}	
}

//Formulario de Búsqueda de insumos
function mostrarSeccion8(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").show();
		$("#menuDatosNegocio").hide();
	} else {
		$("#seccion8").hide();
	}	
}


//Listar los productos en la tabla tblistadoInsumos
function listarIns()
{
	tablaIns=$('#tbllistadoInsumos').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/productos.php?op=busquedaInsumos',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 9, //Paginación
		"order": [[ 0, "asc" ]] //Ordenar (columa, orden)	
	}).DataTable();
}

//Función para copiar horarios del lunes a mar, mie, jue y vie
function copiarHorarios(){
	var value = $("#he_lun").val();
	$("#he_mar").val(value);
	$("#he_mie").val(value);
	$("#he_jue").val(value);
	$("#he_vie").val(value);
	var value1 = $("#hc_lun").val();
	$("#hc_mar").val(value1);
	$("#hc_mie").val(value1);
	$("#hc_jue").val(value1);
	$("#hc_vie").val(value1);
	var value2 = $("#hs_lun").val();
	$("#hs_mar").val(value2);
	$("#hs_mie").val(value2);
	$("#hs_jue").val(value2);
	$("#hs_vie").val(value2);
}

init();
