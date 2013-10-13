{include file="header.tpl" title="Edición de usuario" scripts=$scripts}

{if $muestraBotonMsg==1}
<button title="mensaje" id="buttonMsg">
	Mensaje Privado
</button>
<div id="popupMsg">
	<textarea id="cuerpoMsg" rows="4" cols="40">cuerpo del mensaje</textarea>
	<button title="enviar" id="buttonEnv" onclick="enviarMensaje({$usuarioLogueado},{$idPerfil})">
		Enviar
	</button>
</div>
{/if}
{include file="footer.tpl"}