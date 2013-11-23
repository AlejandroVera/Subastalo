$(document).ready(function() {
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
		try{
			var data = JSON.parse(info);
			if (data.status == 200) {
				parent.conectar(data.usuario);
				window.parent.$("#marco").attr("src", "./inicio.php");
			} else {
				error(data.msg);
			}
		}catch(e){
			alert("Error al enviar el formulario.");
			console.log(e);
		}

	}).fail(function() {
		alert("Error al enviar el formulario. Revise su conexión a Internet.");
	}).always(function() {
		$("#login > :submit").prop('disabled', false);
	});

}
