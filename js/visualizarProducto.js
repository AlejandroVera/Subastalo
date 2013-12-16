var wsuri = "ws://localhost:8080";

function init() {
	conectar();
	var id = getParameterByName("id");
	countdown(1, "visualizarProducto.php?id=" + id);
	$("#pujar").click(function() {
		$("#dialog-form").dialog("open");
	});

	$("#loguear").click(function() {
		var url = encodeURIComponent(window.location.href);
		location.href = "login.php?origen=" + url;
	});

	$("#dialog-form").dialog({
		autoOpen : false,
		height : 200,
		width : 300,
		modal : true,
		buttons : {
			"¡Pujar!" : function() {
				var bValid = true;

				bValid = bValid && !isNaN($("#puja").val());
				if (bValid) {
					pujar();
					$(this).dialog("close");
				} else {
					alert("¡Sólo se aceptan números!");
					location.href = "visualizarProducto.php?id=" + id;
					$(this).dialog("close");
				}
			},
			Cancelar : function() {
				$(this).dialog("close");
			}
		},
	});

	$("#dialog-recarga").dialog({
		autoOpen : false,
		height : 400,
		width : 400,
		modal : true,
		buttons : {
			Cancelar : function() {
				$(this).dialog("close");
			}
		},
	});

	$('#slider').unslider(	{
		speed : 500, //  The speed to animate each slide (in milliseconds)
		delay : 3000, //  The delay between slide animations (in milliseconds)
		complete : function() {
		}, //  A function that gets called after every slide animation
		keys : true, //  Enable keyboard (left, right) arrow shortcuts
		dots : true, //  Display dot navigation
		fluid : false //  Support responsive design. May break non-responsive designs)
		});
	if (GANADOR != "nadie" && NUM_PUJAS != -1 && document.location.href.indexOf("acabaDeTerminar") != -1)
		message("La puja ha finalizado. Ganador: " + GANADOR + " Nº pujas: " + NUM_PUJAS);
	else
		console.log(document.location.href);

	return false;

}

function pujar() {
	$.ajax({
		type : "POST",
		url : "visualizarProducto.php",
		data : $("#datosPuja").serialize(),
	}).done(function(info) {
		try {
			var data = JSON.parse(info);
			if (data.status == 200) {
				if (data.msg == "Puja realizado correctamente.") {
					enviarNotificacionPuja(false);
					messageAndRedirect(data.msg, data.url);
				} else if (data.msg == "No tiene puntos suficientes, por favor recargue más puntos.") {
					mostrarRecarga();
				} else
					messageAndRedirect(data.msg, data.url);
			} else
				error(data.msg);
		} catch(e) {
			alert("Error al enviar la puja.");
			console.log(e);
		}
	}).fail(function() {
		alert("Error al pujar. Revise su conexión a Internet.");
	});

}

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

/*
 * @Necesita un input que sea <input type="hidden" value=tiempo_hasta_finalizacion(seg) name=la_id_donde_quieres _que_aparezca class="countdown">
 *
 * function countdown(showDays,red,redTime)
 * showDays: (1 || 0) 1-> muestra dias que faltan, 0 -> solo horas
 * red: (string) direccion a la que quieres que vaya cuando llegue a 0
 * redTime: lapse de tiempo, una vez finalizado, para que redireccione
 */
function countdown(showDays, red, redTime) {
	//para que no se superpongan las llamadas a las funciones
	if ( typeof (ssid) !== 'undefined')
		window.clearTimeout(ssid);

	//variables
	var mins = 0;
	var horas = 0;
	var dias = 0;
	var date = new Date();
	var seconds = date.getTime() / 1000;
	conDias = showDays;
	if ( typeof (conDias) === 'undefined') {
		conDias = false;
	}

	redirect = red;
	if ( typeof (redirect) === 'undefined') {
		redirect = false;
	}

	timeRed = redTime;
	if ( typeof (timeRed) === 'undefined') {
		timeRed = 450;
	}

	//cuenta regresiva
	todos = $(".countdown");
	for ( i = 0; i < todos.length; i++) {
		endTime = todos[i].value;
		id = todos[i].name;
		sobran = Math.ceil((endTime - seconds));
		if (sobran <= 0) {
			$('#'+id)[0].innerHTML = "0:00:00";
			finalizarSubasta();
			/*
			 if (redirect) {
			 window.setTimeout('document.location.href="' + redirect + '";', timeRed);
			 }*/
			return;
		} else {
			if (sobran > 59) {
				mins = Math.floor(sobran / 60);
				sobran = sobran - mins * 60;
			} else
				mins = 0;

			if (mins > 59) {
				horas = Math.floor(mins / 60);
				mins = mins - horas * 60;
			} else
				horas = 0;

			if (conDias) {
				if (horas > 24) {
					dias = Math.floor(horas / 24);
					horas = horas - dias * 24;
				}
			}
			if (sobran < 10) {
				sobran = "0" + sobran;
			}
			if (mins < 10) {
				mins = "0" + mins;
			}
			if (conDias) {
				if (dias > 0)
					$('#'+id)[0].innerHTML = dias + "d " + horas + ":" + mins + ":" + sobran;
				else
					$('#'+id)[0].innerHTML = horas + ":" + mins + ":" + sobran;
			} else {
				$('#'+id)[0].innerHTML = horas + ":" + mins + ":" + sobran;
			}

		}
	}
	ssid = window.setTimeout("countdown(conDias,redirect,timeRed)", 1000);
}

//Conectar con el servidor de WS
function conectar() {
	ab.connect(wsuri, function(session) {
		sess = session;
		//Subscribirme a mis mensajes.
		sess.subscribe("puja:" + getParameterByName("id"), procesarMensaje);
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sess = null;
		console.log("Connection lost (" + reason + ")");
	});
}

//Acción al recibir un evento
function procesarMensaje(topic, event) {
	window.parent.$("#marco").attr("src", "./visualizarProducto.php?id=" + getParameterByName("id") + ( event ? "&acabaDeTerminar" : ""));
}

function enviarNotificacionPuja(fin) {
	//conectamos con el servidor y enviamos el mensaje
	ab.connect(wsuri, function(session) {
		sessionE = session;
		sessionE.publish("puja:" + getParameterByName("id"), fin);
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sessionE = null;
		console.log("Connection lost (" + reason + ")");
	});
}

function finalizarSubasta() {
	if (SUBASTA_ACABADA == 0) {
		$.post("finalizarSubasta.php", {
			idF : getParameterByName("id")
		}, function(respuesta) {
			enviarNotificacionPuja(true);
		});
	}
}

function recargar(id, valor) {
	$.ajax({
		type : "POST",
		url : "visualizarProducto.php?id=" + id + "&valor=" + valor
	}).done(function(info) {
		try {
			$("#dialog-recarga").dialog("close");
			messageAndRedirect("Muchas gracias, has recargado correctamente tus puntos.", window.location.href);
		} catch(e) {
			alert("Error al enviar la recarga.");
			console.log(e);
		}
	}).fail(function() {
		alert("Error al recargar. Revise su conexión a Internet.");
	});

}

function mostrarRecarga() {
	$("#dialog-recarga").dialog("open");
	var id = $("#idProduct :input").val();
	$(".purchasePoints :button").each(function() {
		$(this).click(function() {
			recargar(id, $(this).val());

		});

	});

}