<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>{$title|default:"Página de subastas"}</title>
		<script src="{$IS2_ROOT_PATH}js/jquery-2.0.3.min.js"></script>
		<script src="{$IS2_ROOT_PATH}js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="{$IS2_ROOT_PATH}js/autobahn.min.js"></script> 
		<script src="{$IS2_ROOT_PATH}js/common.js"></script>
		<script src="{$IS2_ROOT_PATH}js/barra.js"></script>
		{if $IN_ADMIN}
			<script src="{$IS2_ROOT_PATH}js/admin/leftmenu.js"></script>
		{/if}
		{if !empty($scripts)}
			{foreach $scripts as $script}
				<script src="{$IS2_ROOT_PATH}js/{$script}"></script>
			{/foreach}
		{/if}	
		<LINK href="{$IS2_ROOT_PATH}css/framePrincipal2.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/common.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/tablesorter/style.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/tablesorter/jq.css" rel="stylesheet" type="text/css">
		<LINK href="{$IS2_ROOT_PATH}css/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
		{if !empty($css)}
			{foreach $css as $uncss}
				<LINK href="{$IS2_ROOT_PATH}css/{$uncss}" rel="stylesheet" type="text/css">
			{/foreach}
		{/if}
	</head>
	<body onload="initCommonUtilities()" style="margin:0px;padding:0px;overflow-y:auto;overflow-x:hidden;min-width:600px">
		<script type="text/javascript">
			var USER_ACCESS_LEVEL = {$USER_ACCESS_LEVEL};
			{if isset($USUARIO_LOGUEADO)}
				var USUARIO_LOGUEADO = {$USUARIO_LOGUEADO};
			{/if} 
			{if isset($nombreUsuario)}
				var NOMBRE_USUARIO = {$nombreUsuario};
			{/if} 
			
		</script>
		{if $IS_CONTENT}
		<div class="globalContainer">
		{/if}