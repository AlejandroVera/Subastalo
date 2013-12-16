{include file="header.tpl" title="Visualizar producto" scripts=$scripts subastaAcabada=$res.terminado ganador=$ganador numPujas=$numPujas }

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg numMensajes=$numMensajes}

<div id="container">

	<div id="contenedorImagen">
		{if !empty($res.imagenes)}
		<div class="slider-wrapper theme-default">
			<div class="ribbon"></div>
			<div id="slider" class="banner">
			<ul>
				{foreach from=$res.imagenes item=imagen}
				<li><img src="images/uploaded/{$imagen}"></li>
				{/foreach}
				</ul>
			</div>
		</div>
		{else}
		<img src="images/noImage.jpg">
		{/if}
	</div>

	<div id="dataContainer">		
			<div id="nombre">
				{$res.nombre}
			</div>
			{if $res.terminado==1}
			<div class="greyButton" id="pujaTerminada">
				Puja Terminada
			</div>
			{else}
			{if $nivelAcceso==0}
			<div id="loguear">
				<input type="submit" class="greyButton manita" name="pujar" value="¡Loguéate!">
			</div>
			{else}
			<div id="pujar">
				<input type="submit" class="redButton" name="pujar" value="¡Pujar!">
			</div>
			{/if}
			<div id="dialog-form" title="Crear nueva puja">
				{if $res.logueado}
				<div id="saldo">
					Su saldo actual es: {$res.saldo} puntos
				</div>
				{/if}
				<p class="validateTips">
					Introduzca su puja:
				</p>
				<form id="datosPuja">
					<div id="idProducto" style="display:none;">
						<input type="text" name="id" value={$res.id}>
					</div>
					<input type="text" name="puja" id="puja"/>
				</form>
			</div>

			<div id="dialog-recarga" title="Recarga de puntos">
				<div id='recargaPuntos'>

					<div id="idProduct" style="display:none;">
						<input type="text" name="id" value={$res.id}>
					</div>
					<div id='titulo'>
						Recarga de puntos de puja
					</div>
					<div class='separador'></div>
					<div id='coin'>
						<img src="images/spinningCoin.gif" alt='coin' />
					</div>
					<div id='description'>
						No tiene puntos suficientes, por favor recargue más puntos.
					</div>
					<table id='pointsPakagesList'>
						<tbody>
							<tr class='points'>
								<td class='purchasePoints'>
								<button type="submit" name="valor" value="10" class="redButton">
									10 Puntos
								</button></td>
								<td class='price'>
								<div class=priceDiv>
									10 €
								</div></td>
							</tr>
							<tr class='points'>
								<td class='purchasePoints'>
								<button type="submit" name="valor" value="20" class="redButton">
									20 Puntos
								</button></td>
								<td class='price'>
								<div class=priceDiv>
									20 €
								</div></td>
							</tr>
							<tr class='points'>
								<td class='purchasePoints'>
								<button type="submit" name="valor" value="50" class="redButton">
									50 Puntos
								</button></td>
								<td class='price'>
								<div class=priceDiv>
									50 €
								</div></td>
							</tr>
						</tbody>
					</table>

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
		<h1>Descripción</h1>
		<p>{$res.descripcion}</p>
	</div>

</div>

{include file="footer.tpl"}