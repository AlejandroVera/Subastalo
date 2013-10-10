{include file="header.tpl" title="Edición de usuario" scripts=$scripts}

{if $muestraBotonMsg==1}
<button title="mensaje" id="buttonMsg" >
	Mensaje Privado
</button>
{/if}
<div id="popupMsg">
	<textarea rows="4" cols="40">cuerpo del mensaje</textarea>
	<button title="enviar" id="buttonEnv" >
		Enviar
	</button>
</div>
{include file="footer.tpl"}