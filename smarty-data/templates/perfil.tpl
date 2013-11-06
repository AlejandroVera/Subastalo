{include file="header.tpl" title="Edición de usuario" scripts=$scripts}
<p>Perfil de Usuario</p>
{if $muestraBotonMsg==1}
<button title="mensaje" id="buttonMsg">
	Mensaje Privado
</button>
{if $idPerfil!=$usuarioLogueado}
<div id="popupMsg">
	<textarea id="cuerpoMsg" rows="4" cols="40">cuerpo del mensaje</textarea>
	<button title="enviar" id="buttonEnv" onclick="enviarMensaje({$usuarioLogueado},{$idPerfil})">
		Enviar
	</button>
</div>
{/if}
{/if}
{include file="footer.tpl"}