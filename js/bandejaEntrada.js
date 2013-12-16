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
		$("#containerBandeja").find("#"+identificador).css({"font-weight": "normal"});
		$('#vizualizador').show();
	});
}
