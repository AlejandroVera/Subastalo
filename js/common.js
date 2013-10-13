/**
 * Esta función es la primera que se debe ejecutar una vez cargada la página (se hace automáticamente al incluir header.tpl).
 * Se encarga de cargar la funcionalidad básica de la página.
 * Debe ser la que llame al resto de inicializadores de la página.
 */
function initCommonUtilities(){
	var div = document.createElement('div');
	div.id = 'is2_utilities_msg';
	div.innerHTML += '<div id="is2_utilities_msg_topvar"><div id="is2_utilities_msg_topvar_close">X</div></div>';
	div.innerHTML += '<div id="is2_utilities_msg_content"></div>';
	div.innerHTML += '<div id="is2_utilities_msg_options"><input id="is2_utilities_msg_options_accept" value="Aceptar" type="button"></div>';

	//Lo ocultamos por defecto
	$(div).hide();

	//Añadimos todo el contenido al principio del body para que posicione correctamente
	$('body').prepend(div);
	
	//Inicializamos la página
	if(typeof init == 'function')
		init();
}

//TODO: características propias?
function error(msg){
	message(msg);
}

/**
 * Muestra un mensaje emergente en pantalla.
 * @param {String} msg Mensaje a mostrar.
 * @param {Function} onAccept Función que se ejecutará cuando se haga click en el botón de aceptar
 */
function message(msg, onAccept){
	$("#is2_utilities_msg_content").html(msg);
	
	//Cerrar si se hace click en el aspa de cerrar
	$("#is2_utilities_msg_topvar_close").click(function(){
		$("#is2_utilities_msg").hide();
	});
	
	//Cerrar si se pulsa en aceptar
	$("#is2_utilities_msg_options_accept").click(function(){
		$("#is2_utilities_msg").hide();
		if(typeof onAccept == 'function')
			onAccept();
	});
	
	$("#is2_utilities_msg").show();
}

/**
 * Esta función muestra un mensaje y una vez aceptado redirige a una página dada.
 * @param {String} msg Mensaje a mostrar.
 * @param {String} url Url a la que redirigir una vez hayan hecho click en aceptar
 */
function messageAndRedirect(msg, url){
	message(msg, function(){
		location.href = url;
	});
}