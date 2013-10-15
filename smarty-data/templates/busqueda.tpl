{include file="header.tpl" title="Busqueda de producto" scripts=$scripts}
<form id="formularioBusqueda">
	<div class="barraBusqueda">
		<input type="text" name="palabra_clave">
		<input type="submit" value="Buscar">
	</div>
	<div class="tabla">
		<table id=tablaResultados class = "tablesorter">			
		</table>				
	</div>
	<div id = casa></div>	 			
</form>

{include file="footer.tpl"}