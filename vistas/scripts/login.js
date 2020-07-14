	$("#formIniciarS").on('submit', function(e)
	{
		e.preventDefault();
		logina=$("#logina").val();
		clavea=$("#clavea").val();
		
		$.post("../ajax/usuarios.php?op=verificar",
			{"logina":logina,"clavea":clavea},
			function(data)
			{
				if (data!="null")
				{
					if(logina=="admin"){
						$(location).attr("href", "modulo_administrador.php");
					} else {
						$(location).attr("href", "modulo_duenos.php");
					}
				}
				else
				{
					bootbox.alert("Usuario y/o password incorrectos");
				}
			});
	}) 