{include file="header.tpl" title="Visualizar producto" scripts=$scripts}

<div id="container">	
	
		<div id="contenedorImagen">
			{if !empty($res.imagenes)}
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
		<div id="Datos">
			<div id="nombre">
				{$res.nombre}
			</div>
			{if $res.terminado==1}
				<div id="pujaTerminada">Puja Terminada</div>
			{else}
			<div id="pujar">
				<input type="submit" class="redButton" name="pujar" value="¡Pujar!">
			</div>
			<div id="dialog-form" title="Crear nueva puja">
				{if $res.logueado}
				<div id="saldo"> Su saldo actual es: {$res.saldo} puntos</div>
				{/if}
				<p class="validateTips">Introduzca su puja:</p>
				<form id="datosPuja">
					<div id="idProducto" style="display:none;">
					<input type="text" name="id" value={$res.id}>
					</div>
					<input type="text" name="puja" id="puja" class="text ui-widget-content ui-corner-all" />
				</form>
				</div>
			</div>
			
			<div id="crono"></div>
			<input type="hidden" value={$res.hoy} name="crono" class="countdown">
			{/if}
			
			<div id="puntos">
				{if $res.pujado==1 && $terminadosinpujar==0}
					Mejor puja: {$res.puntos} puntos 
				{else if $terminadosinpujar==1}
					No se realizó ninguna puja por este producto T_T...
				{else}
					Mínima puja: 1 punto.
				{/if}
				{if $res.terminado==1 && $res.pujado==1}
					--> Ganador: 
				{else if $res.pujado==1 && $res.terminado==0}
					--> Ganando:
				{/if}
				{if $res.pujado==1}
				({$res.usuario})
				{/if}
			</div>
		</div>	
			
		<div id="Descripcion">
			<br>Descripción:<br>
			{$res.descripcion}
		</div>	
	</div>
		<div id="Descripcion">
			<br>Descripción:<br>
			{$res.descripcion}
		</div>
	
	
</div>
{include file="footer.tpl"}