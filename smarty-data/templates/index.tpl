{include file="header.tpl" title="Pagina principal" scripts=$scripts}
<div id="barra">
{if $nivelAcceso > 0}
	<div id="logoutDiv">Logout</div>
{else}
	<div id="loginDiv">Login</div>
{/if}
<div id="altaDiv">alta</div>
</div>
<iframe src="./inicio.php" id="marco"> Lo sentimos, 
su navegador no soporta iframe. Le recomendamos Mozilla Firefox para visualizar esta web</iframe> 

{include file="footer.tpl"}
