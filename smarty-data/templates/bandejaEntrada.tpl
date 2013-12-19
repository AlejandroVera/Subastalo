{include file="header.tpl" title="Edición de usuario" scripts=$scripts}
{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg}

<div id = "containerBandeja">
		
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
					<div class="usuarioMsg"> <a href="perfil.php?id_perfil={$mn.idFrom}">{$mn.usuario}</a> </div>
					<div class="tituloMsg">{$mn.titulo}</div>
					<div class="fechaMsg">{$mn.fecha}</div>
				</div>
		{/foreach}		
		{else}
			<div id="mensaje" class="mensajeC">La bandeja de entrada está vacía</div>
			<div id="fl" class="flC"><img src="images/foreverAlone.jpg"></div>
			
		{/if}	
</div>


{include file="footer.tpl"}