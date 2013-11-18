<div id="barra">
	<div id="homeButton">
		<a href=index.php>
			<img src=images/subastalo.png>
		</a>
	</div>	
{if $nivelAcceso > 0}
	<div id="logoutDiv" class="menu_element" >Logout</div>
{else}
	<div id="loginDiv" class="menu_element">Login</div>
{/if}
<div id="altaDiv" class="menu_element">Alta</div>
<div class="barraBusqueda">
		<input type="text" id="palabra_clave" name="palabra_clave">
		<input type="button" id="buscar" value="Buscar">
	</div>
{if $nivelAcceso > 1 && !$IN_ADMIN}
<div id="adminDiv" class="menu_element">Admin</div>
{/if}
</div>