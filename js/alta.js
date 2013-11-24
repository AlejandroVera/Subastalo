
function sendAltaForm() {
	$("#formularioAlta > :submit").prop('disabled', true);
	$.ajax({
		type : "POST",
		url : "alta.php?validate",
		data : $("#formularioAlta").serialize(),
	}).done(function(info) {
		try{
			var data = JSON.parse(info);
			if (data.status == 200)
				messageAndRedirect(data.msg, data.url);
			else
				error(data.msg);
		}catch(e){
			alert("Error al enviar el formulario.");
			console.log(e);
		}
	}).fail(function() {
		alert("Error al enviar el formulario. Revise su conexión a Internet.");
	}).always(function() {
		$("#formularioAlta > :submit").prop('disabled', false);
	});

}

