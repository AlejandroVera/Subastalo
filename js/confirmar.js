function init(){
	$("#formularioConfirmar").submit(function(){
		loadConfirmarForm();
		return false;
	});
}

function loadConfirmarForm() {
	$("#formularioConfirmar > :submit").prop('disabled', true);
	$.ajax({
		type: "POST",
		url: "confirmar.php?confirmar",
		data : $("#formularioConfirmar").serialize(),
	})
	.done(function(info){
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
	})
	.fail(function(){
		error("Error al enviar el formulario. Revise su conexión a Internet.");
	})
	.always(function(){
		$("#formularioConfirmar > :submit").prop('disabled', false);
	});

}

