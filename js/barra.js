$(document).ready(function() {

	$("#loginDiv").click(function() {

		window.parent.$("#marco").attr("src", "./login.php");
	});

	$("#logoutDiv").click(function() {

		window.parent.$("#marco").attr("src", "./logout.php");
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

	$("#adminDiv").click(function() {
		window.parent.$("#marco").attr("src", "./admin/index.php");
	});

	$("#edperfil").click(function() {
		window.parent.$("#marco").attr("src", "./editarPerfil.php");
	});

	$("#cambiarC").click(function() {
		window.parent.$("#marco").attr("src", "./cambiopasswd.php");
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
