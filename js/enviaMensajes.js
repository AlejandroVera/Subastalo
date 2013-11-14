var sess;
var wsuri = "ws://localhost:8080";

function init() {
	$("#popupMsg").hide();
	$("#buttonMsg").click(function() {
		$("#popupMsg").show();
	});
	conectar();
}


function enviarMensaje(fromMsg, toMsg) {
	var cuerpo = {
		from : fromMsg,
		cuerpo : $("#cuerpoMsg").val()
	};
	sess.publish("msg://" + toMsg, cuerpo);
}

//Conectar con el servidor de WS
function conectar() {
	ab.connect(wsuri, function(session) {
		sess = session;
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sess = null;
		console.log("Connection lost (" + reason + ")");
	});
}