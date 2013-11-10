{include file="header.tpl" title="Busqueda de producto" scripts=$scripts}
<div class="tabla">				
	<table id = historial>
		<tr>
			<th>Nombre</th>
			<th>Tipo</th>
			<th>Puntos</th>
			<th>Fecha</th>
		</tr>
		{foreach from=$historial item=fila}
			<tr>
				<td>{$fila['nombre']}</td>
				<td>{$fila['tipo']}</td>
				<td>{$fila['puntos']}</td>
				<td>{$fila['fecha']}</td>
			</tr>
		{/foreach}
	</table>									
</div>
{include file="footer.tpl"}
 		
