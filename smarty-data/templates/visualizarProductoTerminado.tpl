{include file="header.tpl" title="Visualizar producto" scripts=$scripts}

{if {$imagen}}
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
	   {foreach from=$res.imagenes item=imagen}
	    <img src="images/{$imagen}" alt="" data-transition="slideInLeft"/>
	   {/foreach}
	</div>
</div>	
	
<div id="Datos">
	<div id="nombre">
		{$res.nombre}
	</div>
	
	<div id="pujaTerminada">Puja Terminada</div>

	<div id="dialog">
	<div id="Popup"></div>
	</div>
	
	<div id="puntos">
		Mejor puja: {$res.puntos} puntos --> Ganador: ({$res.usuario})
	</div>
</div>

<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>


{include file="footer.tpl"}