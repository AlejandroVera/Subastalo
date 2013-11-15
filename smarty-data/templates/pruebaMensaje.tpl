{include file="header.tpl" title="Prueba Mensajes" scripts=$scripts}

<div>
	<div>usuario origen</div>
	<input type="text" id="idUsuarioOrigen" >
	<div>usuario destino</div>
	<input type="text" id="idUsuarioDestino">
	<textarea id="cuerpoMsg" rows="4" cols="40">cuerpo del mensaje</textarea>
	<button title="enviar" id="buttonEnv" onclick="enviarMensaje()">
		Enviar
	</button>
</div>
{include file="footer.tpl"}