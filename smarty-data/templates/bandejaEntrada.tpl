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
		
		{if isset($noLeidos)}
		{foreach $noLeidos as $noL}
				<div id="{$noL.id}" onclick="mostrarMensaje({$noL.id})">{$noL.datos}</div>
		{/foreach}		
		{/if}	
</div>


{include file="footer.tpl"}