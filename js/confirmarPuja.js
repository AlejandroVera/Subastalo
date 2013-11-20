function init(){
	$("#confirmarPuja").submit(function(){
		var id=getParameterByName("idProducto");
		pujar(id);
		return false;
	});
//	$("#cancelar").click(function(){
//		$("#confirmarPuja").hide();
//	});
	
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function pujar(id) {
	$("#editarPerfil > :submit").prop('disabled', true);
	$.ajax({
		type: "POST",
		url: "confirmarPuja.php,
		data : $("#confirmarPuja").serialize(),
	})
	.done(function(info){
		try{
			var data = JSON.parse(info);
			if (data.status == 200)
				messageAndRedirect(data.msg, data.url);
			else
				error(data.msg);
		}catch(e){
			alert("Error al enviar la puja.");
			console.log(e);
		}
	})

	.fail(function(){
		alert("Error al pujar. Revise su conexión a Internet.");
	})
	.always(function(){
		$("#editarPerfil > :submit").prop('disabled', false);
	});

}

