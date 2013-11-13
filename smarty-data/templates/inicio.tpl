{include file="header.tpl" title="Pagina principal" scripts=$scripts}

<div id="barra">
{if $nivelAcceso > 0}
	<div id="logoutDiv" class="menu_element" >Logout</div>
{else}
	<div id="loginDiv" class="menu_element">Login</div>
{/if}
<div id="altaDiv" class="menu_element">Alta</div>
{if $nivelAcceso > 1 && !$IN_ADMIN}
<div id="adminDiv" class="menu_element">Admin</div>
{/if}
</div>

<div><p>Pagina principal</p></div>

{include file="footer.tpl"}