<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>{$title|default:"Página de subastas"}</title>
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		{if !empty($scripts)}
			{foreach $scripts as $script}
				<script src="./js/{$script}"></script>
			{/foreach}
		{/if}	
	</head>
	<body onload="init()">