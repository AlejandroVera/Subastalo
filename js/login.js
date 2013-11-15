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
		window.parent.$("#marco").attr("src", "./admin/index.php");
	});

	$("#accederLogin").click(function() {
		sendLoginForm();
		return false;
	});

});

function sendLoginForm() {
	$("#login > :submit").prop('disabled', true);
	$.ajax({
		type : "POST",
		url : "login.php?validate",
		data : $("#login").serialize(),
	}).done(function(info) {
		var data = JSON.parse(info);
		if (data.status == 200) {
			parent.conectar(data.usuario);
		} else {
			error(data.msg);
		}

	}).fail(function() {
		alert("Error al enviar el formulario. Revise su conexión a Internet.");
	}).always(function() {
		$("#login > :submit").prop('disabled', false);
	});

}
