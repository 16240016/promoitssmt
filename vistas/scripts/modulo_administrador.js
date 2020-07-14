var tabla;

//Función que se ejecuta al inicio
function init()
{
	mostrarformUsuarios(false);
	mostrarformGiro(false);
	mostrarSeccion1(false);
	mostrarSeccion2(false);
	mostrarSeccion3(false);
	mostrarSeccion4(false);
	listarDP();
	listarIN();
	
	//Mostrar Carousel dinamico 
	$.post("../ajax/info_negocio.php?op=carousel", function(r) {
		$("#divCarousel").html(r);
	})
}


//Sección de Usuarios
function mostrarSeccion1(flag)
{
	if(flag){
		$("#seccion1").show();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion1").hide();
	}
	
}

//Sección de Datos Personales
function mostrarSeccion2(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").show();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion2").hide();
	}
	
}

//Sección de Datos del Negocio
function mostrarSeccion3(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").show();
		$("#seccion4").hide();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion3").hide();
	}
	
}

//Sección de Giros
function mostrarSeccion4(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").show();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion4").hide();
	}
	
}

//Formulario para editar o agregar un usuario
function mostrarformUsuarios(flag)
{
	limpiarU();
	if (flag) {
		$("#ventanaEditUsuario").show();
		$("#btnGuardarUusarios").prop("disabled", false);
		$("btnagregarUsuario").hide();
	} else {
		$("#ventanaEditUsuario").hide();
	}
	
}

//Formulario para editar o agregar un giro
function mostrarformGiro(flag)
{
	limpiarG();
	if (flag) {
		$("#ventanaEditGiro").show();
		$("#btnGuardarGiro").prop("disabled", false);
		$("btnagregarGiro").hide();
	} else {
		$("#ventanaEditGiro").hide();
	}
	
}

//Funcion limpiar
function limpiarU()
{
	$("#idusuario").val("");
	$("#n_usuario").val("");
	$("#c_usuario").val("");
}
//Funcion limpiar

function limpiarG()
{
	$("#idgiro").val("");
	$("#n_giro").val("");
	$("#d_giro").val("");
}

//Listar los datos personales en la tabla tbllistadoDatosPersonales
function listarDP()
{
	tabla=$('#tbllistadoDatosPersonales').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/datos_personales.php?op=listar',
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


//Listar la información del negocio en la tabla tbllistadoDatosPersonales
function listarIN()
{
	tabla=$('#tbllistadoInformacionNegocio').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/info_negocio.php?op=listar',
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

init();