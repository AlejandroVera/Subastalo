sess = "null";
var wsuri = "ws://localhost:8080";

//Acción al recibir un evento
function onEvent(topic, event) {
	alert("un mensaje nuevo de "+topic+" contiene: "+event);
}

//Conectar con el servidor de WS
function conectar(usuarioLogueado) {
	
	alert("hola: "+ usuarioLogueado);
	/*
	ab.connect(wsuri, function(session) {
		sess = session;
		//Subscribirme a mis mensajes.
		sess.subscribe("msg://" + usuarioLogueado, onEvent);
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sess = null;
		console.log("Connection lost (" + reason + ")");
	});
	*/
}









/*
	$("#marco").attr("src", "./inicio.php");

	$("#loginDiv").click(function() {
		$("#marco").attr("src", "./login.php");
	});

	$("#altaDiv").click(function() {
		$("#marco").attr("src", "./alta.php");
	});
	
	$("#adminDiv").click(function() {
		$("#marco").attr("src", "./admin/index.php");
	});

});

function putLogoutButton() {
	$("#loginDiv").replaceWith("<div id=\"logoutDiv\" class=\"menu_element\" >Logout</div>");
	$("#logoutDiv").click(function() {
		$("#marco").attr("src", "./logout.php");
	});
}

function putLoginButton() {
	$("#logoutDiv").replaceWith("<div id=\"loginDiv\" class=\"menu_element\" >Login</div>");
	$("#loginDiv").click(function() {
		$("#marco").attr("src", "./login.php");
	});
}
*/