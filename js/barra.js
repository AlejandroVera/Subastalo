$(document).ready(function() {
	$("#loginDiv").click(function() {
		var url = encodeURIComponent(window.location.href);
		window.parent.$("#marco").attr("src", "./login.php?origen="+url);
	});

	$("#logoutDiv").click(function() {

		window.parent.$("#marco").attr("src", "./logout.php");
	});

	$("#homeButton").click(function() {
		window.parent.$("#marco").attr("src", "./inicio.php");
	});
	
	$("#altaDiv").click(function() {
		window.parent.$("#marco").attr("src", "./alta.php");
	});

	$("#adminDiv").click(function() {
		$("#marco").attr("src", "./admin/index.php");
	});

	$("#buscar").click(function() {
		var pal = $("#palabra_clave")[0].value;
		window.parent.$("#marco").attr("src", "./busqueda.php?palabra_clave=" + pal);
	});

	$("#palabra_clave").keyup(function(event) {
		if (event.keyCode == 13) {
			$("#buscar").click();
		}
	});

	$("#adminDiv").click(function() {
		window.parent.$("#marco").attr("src", "./admin/index.php");
	});

	$("#edperfil").click(function() {
		window.parent.$("#marco").attr("src", "./editarPerfil.php");
	});

	$("#cambiarC").click(function() {
		window.parent.$("#marco").attr("src", "./cambiopasswd.php");
	});

	$("#recibirMsg").click(function() {
		sendEstadoMensajes("a");
		$("#recibirMsg").hide();
		$("#NoRecibirMsg").show();
	});

	$("#NoRecibirMsg").click(function() {
		sendEstadoMensajes("d");
		$("#NoRecibirMsg").hide();
		$("#recibirMsg").show();
	});

	$("#formularioAlta").submit(function() {
		sendAltaForm();
		return false;
	});
	$(".list").hide();

	$("#panelDiv").hover(function() {
		$(".list").show();
		//que hacer al acercar el raton
	}, function() {
		//que hacer al alejar el raton
	});

	$("#panelDiv").click(function() {
		$(".list").show();
	});

	$('html').click(function() {
		$(".list").hide();
	});
	
	$("#bandeja").click(function() {
		window.parent.$("#marco").attr("src", "./bandejaEntrada.php");
	});
	
});

function sendAltaForm() {
	$("#formularioAlta > :submit").prop('disabled', true);
	$.ajax({
		type : "POST",
		url : "alta.php?validate",
		data : $("#formularioAlta").serialize(),
	}).done(function(info) {
		try {
			var data = JSON.parse(info);
			if (data.status == 200)
				messageAndRedirect(data.msg, data.url);
			else
				error(data.msg);
		} catch(e) {
			alert("Error al enviar el formulario.");
			console.log(e);
		}
	}).fail(function() {
		alert("Error al enviar el formulario. Revise su conexión a Internet.");
	}).always(function() {
		$("#formularioAlta > :submit").prop('disabled', false);
	});

}

function sendEstadoMensajes(estado) {
	$.post("estadoMensajes.php", {
		usuario : USUARIO_LOGUEADO.toString(),
		estado : estado.toString()
	}, function(respuesta) {

	});
}

