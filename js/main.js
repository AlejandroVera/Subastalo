sess = "null";
var wsuri = "ws://localhost:8080";

//Acción al recibir un evento
function procesarMensaje(topic, event) {
	alert("un mensaje nuevo de "+topic+" contiene: "+event.cuerpo);
}

//Conectar con el servidor de WS
function conectar(usuarioLogueado) {
	ab.connect(wsuri, function(session) {
		sess = session;
		//Subscribirme a mis mensajes.
		sess.subscribe("msg:" + usuarioLogueado, procesarMensaje);
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sess = null;
		console.log("Connection lost (" + reason + ")");
	});
}
