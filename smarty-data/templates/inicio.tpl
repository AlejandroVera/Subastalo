{include file="header.tpl" title="Pagina principal" USUARIO_LOGUEADO=$USUARIO_LOGUEADO}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg numMensajes=$numMensajes}


	<div id="slider" class="banner">
	<ul>
		{foreach from=$random item=elem}
			{if !empty($elem['imagen']) }
				<li><img src="images/uploaded/{$elem['imagen']}"</li>
			{else}
				<li><img src="images/noImage.jpg"></li>
			{/if}
		{/foreach}
		</ul>		
	</div>


<div id="acabanAntes" class="container">
	<div class="titulo">A punto de terminar</div>
	
	{foreach from=$acabanAntes item=elem}
		<div class="resultadoInicio" data-url="visualizarProducto.php?tipo=subasta&id={$elem['id']}">
			<div class="nombreResultado">{$elem['nombre']}</div>
			{if !empty($elem['imagen']) }
				<img class="imagenResultado" src="images/uploaded/{$elem['imagen']}" >
			{else}
				<img src="images/noImage.jpg">	
			{/if}			
		</div>		
	{/foreach}	
	
</div>

<div id="nuevas" class="container">
	<div class="titulo">Nuevos productos en subasta</div>
	
	{foreach from=$nuevas item=elem}
		<div class="resultadoInicio" data-url="visualizarProducto.php?tipo=subasta&id={$elem['id']}">
			<div class="nombreResultado">{$elem['nombre']}</div>
			{if !empty($elem['imagen']) }
				<img class="imagenResultado" src="images/uploaded/{$elem['imagen']}" />
			{else}
				<img src="images/noImage.jpg">	
			{/if}
		</div>
	{/foreach}
	
</div>

{include file="footer.tpl"}