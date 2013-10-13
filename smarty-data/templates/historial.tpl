<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Alta de usuario</title>
	</head>
	<body>
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
</body>
</html> 		
