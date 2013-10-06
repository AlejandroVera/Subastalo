<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Alta de usuario</title>
	</head>
	<body>
		<form action="busqueda.php?validate" method="POST">
			<div class="barraBusqueda">
				<input type="text" name="palabra_clave">
				<input type="submit" value="Buscar">
			</div> 
			<div class="tabla">				
				{if !empty($tabla)}
					{html_table loop=$tabla cols=1}
				{/if}				
			</div> 		
		</form>
	</body>
</html>