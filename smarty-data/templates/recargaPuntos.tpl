{include file="header.tpl" title="Recarga de puntos de puja" scripts=$scripts}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN aceptaMsg=$aceptaMsg}


<form id='recargaPuntos' method='POST' action="recargaPuntos.php?validate">
	<fieldset class='box'>
		<div id='titulo'> 
			"Recarga de puntos de puja"
		</div>
		<div id='coin'>
			<img src="images/coin.GIF" alt='coin' />
		</div>
		<div id='description'>
			"Con los puntos de pujas puedes participar de forma activa en pujas de productos de puja."
		</div>
		<div id='separador'></div>
		<table id='pointsPakagesList'>
			<tbody>
				<tr class='points'>
					<td class='purchasePoints'>
						<button type="submit" name="valor" value="10">10 Puntos</button>
					</td>
					<td class='price'>
						<div class=priceDiv>
							"10 €"
						</div>
					</td>
				</tr>
				<tr class='points'>
					<td class='purchasePoints'>
						<button type="submit" name="valor" value="20">20 Puntos</button>
					</td>
					<td class='price'>
						<div class=priceDiv>
							"20 €"
						</div>
					</td>
				</tr>
				<tr class='points'>
					<td class='purchasePoints'>
						<button type="submit" name="valor" value="50">50 Puntos</button>
					</td>
					<td class='price'>
						<div class=priceDiv>
							"50 €"
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</form>

{include file="footer.tpl"}