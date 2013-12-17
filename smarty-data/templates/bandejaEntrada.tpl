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
		{foreach $mensajes as $key => $mn}
		{if $mn.leido == 0}
			{if $key==0}
				<div class="entradaMsg nuevo first" id="{$mn.id}" onclick="mostrarMensaje({$mn.id})">
			{else}
				<div class="entradaMsg nuevo" id="{$mn.id}" onclick="mostrarMensaje({$mn.id})">
			{/if}
		{/if}
		{if $mn.leido == 1}
			{if $key==0}
				<div class="entradaMsg first" id="{$mn.id}" onclick="mostrarMensaje({$mn.id})">
			{else}
				<div class="entradaMsg" id="{$mn.id}" onclick="mostrarMensaje({$mn.id})">
			{/if}
		{/if}
					<div class="usuarioMsg">{$mn.usuario}</div>
					<div class="tituloMsg">{$mn.titulo}</div>
					<div class="fechaMsg">{$mn.fecha}</div>
				</div>
		{/foreach}		
		{/if}	
</div>


{include file="footer.tpl"}