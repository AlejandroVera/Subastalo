{include file="header.tpl" title="Confirmar Puja" scripts=$scripts}
<form id="confirmarPuja">
<div id="Entrada">Introduzca su puja:</div>
<div id="cantidadPuja">
<input type="number" name="puja" >
</div>

<input id="submit" type="submit" value="¡Pujar!">
<div id="idProducto" style="display:none;">
<input type="text" name="idProducto" value={$idProducto}>
</div>


<!--<button id="cancelar" type="button">Cancelar</button>-->

</form>

{include file="footer.tpl"}
