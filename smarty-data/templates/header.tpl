<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>{$title|default:"Página de subastas"}</title>
		<script src="{$IS2_ROOT_PATH}/js/jquery-2.0.3.min.js"></script>
		<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script> 
		<script src="{$IS2_ROOT_PATH}js/common.js"></script>
		{if !empty($scripts)}
			{foreach $scripts as $script}
				<script src="{$IS2_ROOT_PATH}js/{$script}"></script>
			{/foreach}
		{/if}
		<LINK href="{$IS2_ROOT_PATH}css/framePrincipal2.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/common.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/tablesorter/style.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/tablesorter/jq.css" rel="stylesheet" type="text/css">
	</head>
	<body onload="initCommonUtilities()">