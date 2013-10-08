function init(){
	$("#cambiarPass").submit(function(){
		changePass();
		return false;
	});
}

function changePass() {
	$("#cambiarPass > :submit").prop('disabled', true);
	$.ajax({
		type: "POST",
		url: "cambiopasswd.php?validate",
		data : $("#cambiarPass").serialize(),
	})
	.done(function(info){
		var data = JSON.parse(info);
		if (data.status == 200)
			messageAndRedirect(data.msg, data.url);
		else
			error(data.msg);
	})

	.fail(function(){
		alert("Error al cambiar la contraseña. Revise su conexión a Internet.");
	})
	.always(function(){
		$("#cambiarPass > :submit").prop('disabled', false);
	});

}

function error(msg){
	alert(msg);
}

function messageAndRedirect(msg, url){
	alert(msg);
	location.href = url;
}