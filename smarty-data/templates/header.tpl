<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>{$title|default:"Página de subastas"}</title>
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script> 
		<script src="./js/common.js"></script>
		{if !empty($scripts)}
			{foreach $scripts as $script}
				<script src="./js/{$script}"></script>
			{/foreach}
		{/if}
		<LINK href="./css/common.css" rel="stylesheet" type="text/css">
		<LINK href="./css/tablesorter/style.css" rel="stylesheet" type="text/css">
		<LINK href="./css/tablesorter/jq.css" rel="stylesheet" type="text/css">
	</head>
	<body onload="initCommonUtilities()">