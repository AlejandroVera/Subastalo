{include file="header.tpl" title="Pagina principal" scripts=$scripts}
<p>Pagina principal</p>
<a id="alta" href="alta.php">Alta</a>
{if $nivelAcceso > 0}
	<a href="logout.php">Logout</a>
{else}
	<a id="login" >Login</a>
{/if}
{include file="footer.tpl"}
