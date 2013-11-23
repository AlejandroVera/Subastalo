{include file="header.tpl" title="Busqueda de producto" scripts=$scripts css=$css IS_CONTENT=false}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN aceptaMsg=$aceptaMsg}

<div id = "container">
	<div class="tabla">
		<table id=tablaResultados class = "tablesorter">
			{$tabla}			
		</table>				
	</div>	 			
</div>

{include file="footer.tpl"}