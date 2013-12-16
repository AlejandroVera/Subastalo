$(document).ready(function() {
	$("#bCerrarM").click(function() {
		$("#vizualizador").hide();
	});
});
function mostrarMensaje(identificador){
	$.post("mostrarMensaje.php", {
		id : identificador.toString()
	}, function(respuesta) {
		var data = JSON.parse(respuesta);
		$('#asuntoV').html(data.asunto);
		$('#cuerpoV').html(data.cuerpo);
		$('#vizualizador').show();
	});
}
