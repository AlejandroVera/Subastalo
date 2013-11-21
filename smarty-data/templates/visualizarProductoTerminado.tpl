{include file="header.tpl" title="Visualizar producto" scripts=$scripts}
{if $res.pujado==1}
{if $res.imagenes!=null}
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
	   {foreach from=$res.imagenes item=imagen}
	    <img src="images/{$imagen}" alt="" data-transition="slideInLeft"/>
	   {/foreach}
	</div>
</div>	
{/if}	
<div id="Datos">
	<div id="nombre">
		{$res.nombre}
	</div>
	
	<div id="pujaTerminada">Puja Terminada</div>
	
	<div id="puntos">
		Mejor puja: {$res.puntos} puntos --> Ganador: ({$res.usuario})
	</div>
</div>

<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>
{else}
{if $res.imagenes!=null}
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
	   {foreach from=$res.imagenes item=imagen}
	    <img src="images/{$imagen}" alt="" data-transition="slideInLeft"/>
	   {/foreach}
	</div>
</div>	
{/if}	
<div id="Datos">
	<div id="nombre">
		{$res.nombre}
	</div>
	
	<div id="pujaTerminada">Puja Terminada</div>
	
	<div id="puntos">
		No hubo puja por este producto T_T
	</div>
</div>

<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>
{/if}

{include file="footer.tpl"}