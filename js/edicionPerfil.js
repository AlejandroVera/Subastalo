function init(){
	$("#editarPerfil").submit(function(){
		editProfile();
		return false;
	});
}

function editProfile() {
	$("#editarPerfil > :submit").prop('disabled', true);
	$.ajax({
		type: "POST",
		url: "editarPerfil.php?validate",
		data : $("#editarPerfil").serialize(),
	})
	.done(function(info){
		var data = JSON.parse(info);
		if (data.status == 200)
			messageAndRedirect(data.msg, data.url);
		else
			error(data.msg);
	})

	.fail(function(){
		alert("Error al actualizar el perfil. Revise su conexión a Internet.");
	})
	.always(function(){
		$("#editarPerfil > :submit").prop('disabled', false);
	});

}

