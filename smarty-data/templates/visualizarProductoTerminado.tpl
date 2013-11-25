{include file="header.tpl" title="Visualizar producto" scripts=$scripts}
<div id="container">
<div id="contenedorImagen">
{if $res.imagenes!=null}
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
	   {foreach from=$res.imagenes item=imagen}
	    <img src="images/{$imagen}" alt="" data-transition="slideInLeft"/>
	   {/foreach}
	</div>
</div>
{else}
	<img src="images/noImage.jpg">
{/if}
</div>

<div id="dataContainer">
{if $res.pujado==1}
	
<div id="Datos">
	<div id="nombre">
		{$res.nombre}
	</div>
	
	<div id="pujaTerminada">Puja Terminada</div>
	
	<div id="puntos">
		Mejor puja: {$res.puntos} puntos --> Ganador: ({$res.usuario})
	</div>
</div>
</div>
<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>
{else}
	
<div id="Datos">
	<div id="nombre">
		{$res.nombre}
	</div>
	
	<div id="pujaTerminada">Puja Terminada</div>
	
	<div id="puntos">
		No hubo puja por este producto T_T
	</div>
</div>
</div>
<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>
{/if}
</div>
{include file="footer.tpl"}