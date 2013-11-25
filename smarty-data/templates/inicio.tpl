{include file="header.tpl" title="Pagina principal" USUARIO_LOGUEADO=$USUARIO_LOGUEADO}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg} 

<div><p>Pagina principal</p></div>
<div id="random">
	<div class="slider-wrapper theme-default">
		<div class="ribbon"></div>
		<div id="slider" class="nivoSlider">
			{foreach from=random item=elem}
				{if !empty($elem['imagen']) }
					<img src="images/uploaded/{$elem['imagen']}" alt="" data-transition="slideInLeft"/>
				{else}
					<img src="images/noImage.jpg">	
				{/if}
	   		{/foreach}
		</div>
	</div>
</div>
<div id="acabanAntes">
	<div>A punto de terminar</div>
	<div>
	{foreach from=$acabanAntes item=elem}
		<div class="resultadoInicio">
			<div class="nombreResultado">{$elem['nombre']}</div>
			{if !empty($elem['imagen']) }
				<img class="imagenResultado" src={$elem['imagen']} />
			{else}
				<img src="images/noImage.jpg">	
			{/if}
			<img class="imagenResultado" src={$elem['imagen']} />
		<div>
	{/foreach}
	</div>
</div>
<div id="nuevas">
	<div>Nuevos productos en subasta</div>
	<div>
	{foreach from=$nuevas item=elem}
		<div class="resultadoInicio">
			<div class="nombreResultado">{$elem['nombre']}</div>
			{if !empty($elem['imagen']) }
				<img class="imagenResultado" src={$elem['imagen']} />
			{else}
				<img src="images/noImage.jpg">	
			{/if}
		<div>
	{/foreach}
	</div>
</div>

{include file="footer.tpl"}