//Función que se ejecuta al inicio
function init()
{
	mostrarProductos(false);
	mostrarServicios(false);
	mostrarForm(false);

	//Listar los giros en productos
	$.post("../ajax/info_negocio.php?op=selectGiro", function(r) {
		$("#idgiro").html(r);
		$("#idgiro2").html(r);
	})

	//Mostrar Carousel dinamico 
	$.post("../ajax/info_negocio.php?op=carousel", function(r) {
		$("#divCarousel").html(r);
	})
	
	recargarConsulta();

	$("#idgiro").change(function(){
		recargarConsulta();
	})

}

function recargarConsulta()
{
	$.ajax({
		url: "../ajax/info_negocio.php?op=consultaProductos",
		type: "POST",
		data: "giro="+ $("#idgiro").val(),	
		success: function(r)
		{
			$("#divConsultas").html(r);
		}	
		
	});



}

//Función mostrar formulario
function mostrarProductos(flag)
{
	if (flag) {
		$("#divCarousel").hide();
		$("#selectProductos").show();
		$("#selectServicios").hide();
		$("#divConsultas").show();
		$("#formulario").hide();
		//$("#menuBotones").hide();
	} else {
		$("#selectProductos").hide();
		$("#divConsultas").hide();
		//$("#menuBotones").show();
	}
}

function mostrarServicios(flag)
{
	if (flag) {
		$("#divCarousel").hide();
		$("#selectProductos").hide();
		$("#selectServicios").show();
		$("#divConsultas").show();
		$("#formulario").hide();
		//$("#menuBotones").hide();
	} else {
		$("#selectServicios").hide();
		$("#divConsultas").hide();
		//$("#menuBotones").show();
	}
}

function mostrarForm(flag)
{
	if(flag){
		$("#formulario").show();
	} else {
		$("#formulario").hide();
	}
}

function cancelarform(){
	$("#formulario").hide();
}

init();