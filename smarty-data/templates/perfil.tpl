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

<div class="entradaEdicion">
	Usuario: {$res.username} 
</div>

<div class="entradaEdicion">
	Teléfono:{$res.telefono}
</div>
<div class="entradaEdicion">
	Email:{$res.email}
</div>
<div class="textoentradaEdicion">
	{if $lista!=null}
	Lista de mis intereses:	
		{foreach key=key item=item from=$lista}
			{if $item == 1}
				<div class="valorEntradaTabla">
					{$key}
				</div>
			{/if}
			
		{/foreach}
	{/if}
</div>
<div class="entradaEdicion">
	{if $res.productosInteresados!=""}
	 Estoy interesado en: {$res.productosInteresados}
	{/if}
</div>
{include file="footer.tpl"}