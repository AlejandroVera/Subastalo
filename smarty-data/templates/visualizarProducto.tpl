{include file="header.tpl" title="Visualizar producto" scripts=$scripts}

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
	{if $res.ganada==1}
		<div id="pujaTerminada">Puja Terminada</div>
	{else}
	<div id="pujar">
		<input type="submit" name="pujar" value="¡Pujar!">
	</div>
	<div id="dialog-form" title="Crear nueva puja">
		<p class="validateTips">Introduzca su puja:</p>
		<form id="datosPuja">
			<div id="idProducto" style="display:none;">
			<input type="text" name="idProducto" value={$res.idProducto}>
			</div>
			<input type="text" name="puja" id="puja" class="text ui-widget-content ui-corner-all" />
		</form>
		</div>
	</div>
	<div id="crono"></div>
	<input type="hidden" value={$res.hoy} name="crono" class="countdown">
	{/if}
	
	<div id="puntos">
		Mejor puja: {$res.puntos} puntos 
		{if $res.ganada==1}--> Ganador: {/if}
		({$res.usuario})
	</div>
</div>

<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>



{include file="footer.tpl"}