{include file="header.tpl" title="Edición de usuario" scripts=$scripts}
{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg}

<div id = "containerBandeja">
		<div id="vizualizador" style="display:none">
			<div id="asuntoV"></div>
			<div id="cuerpoV"></div>
			<button title="cerrar" id="bCerrarM">
				cerrar
			</button>
		</div>
		
		{if isset($mensajes)}
		{foreach $mensajes as $mn}
		{if $mn.leido == 0}
				<div id="{$mn.id}" onclick="mostrarMensaje({$mn.id})" style="font-weight: bold;">{$mn.datos}</div>
		{/if}
		{if $mn.leido == 1}
			<div id="{$mn.id}" onclick="mostrarMensaje({$mn.id})">{$mn.datos}</div>
		{/if}
		{/foreach}		
		{/if}	
</div>


{include file="footer.tpl"}