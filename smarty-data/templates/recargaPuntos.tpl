{include file="header.tpl" title="Recarga de puntos de puja" scripts=$scripts IS_CONTENT=false}
{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN aceptaMsg=$aceptaMsg}

<form id='recargaPuntos' method='POST' action="recargaPuntos.php?validate">
	<div>
		<div id='titulo'> 
			Recarga de puntos de puja
		</div>
		<div class='separador'></div>
		<div id='coin'>
			<img src="images/spinningCoin.gif" alt='coin' />
		</div>
		<div id='description'>
			Con los puntos de subasta puedes pujar de forma activa en subastas
		</div>		
		<table id='pointsPakagesList'>		
			<tbody>
				<tr class='points'>
					<td class='purchasePoints'>
						<button type="submit" name="valor" value="10" class="redButton">10 Puntos</button>
					</td>
					<td class='price'>
						<div class=priceDiv>
							10 €
						</div>
					</td>
				</tr>
				<tr class='points'>
					<td class='purchasePoints'>
						<button type="submit" name="valor" value="20" class="redButton">20 Puntos</button>
					</td>
					<td class='price'>
						<div class=priceDiv>
							20 €
						</div>
					</td>
				</tr>
				<tr class='points'>
					<td class='purchasePoints'>
						<button type="submit" name="valor" value="50" class="redButton">50 Puntos</button>
					</td>
					<td class='price'>
						<div class=priceDiv>
							50 €
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</form>

{include file="footer.tpl"}