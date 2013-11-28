function init(){
	$("#accederLogin").click(function() {
		sendLoginForm();
		return false;
	});

}

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
				var origen=getParameterByName("origen");
				if(origen == null || origen=="")
					origen="inicio.php";
				window.parent.$("#marco").attr("src", origen);
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

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

