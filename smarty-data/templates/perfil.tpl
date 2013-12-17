{include file="header.tpl" title="Pagina principal" USUARIO_LOGUEADO=$USUARIO_LOGUEADO numMensajes=$numMensajes}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg}

<p>Perfil de Usuario</p>
{if $aceptaMsg==1 && $idPerfil != $usuarioLogueado && isset($USUARIO_LOGUEADO)}
<button title="mensaje" id="buttonMsg">
	Mensaje Privado
</button>
<div id="popupMsg" style="display:none">
	<textarea id="asuntoMsg" rows="1" cols="40">asunto</textarea>
	<textarea id="cuerpoMsg" rows="4" cols="40">cuerpo</textarea>
	<button title="enviar" id="buttonEnv">
		Enviar
	</button>
</div>
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

<div class="tabla">
		<table id=historial class = "tablesorter">
			{$historial}			
		</table>				
	</div>	
{include file="footer.tpl"}