<div id="barra">
	<div id="homeButton">
	{if !$IN_ADMIN}
		<img src=images/subastalo.png>
	{else}
		<img src=../images/subastalo.png>
	{/if}
	</div>	
{if $nivelAcceso > 0}
		
	<div id="lista" class="list" >
  			<div class="listElement" id="edperfil">Editar Perfil</div>
  			<div class="listElement" id="verPerfil">Ver Perfil</div>
  			<div class="listElement" id="cambiarC">Cambiar Contraseña</div>
  			{if $aceptaMsg==1}
  				<div class="listElement" id="NoRecibirMsg">Deshabilitar Mensajes Privados</div>
  				<div class="listElement" id="recibirMsg" hidden >Habilitar Mensajes Privados</div>
  			{else}
  				<div class="listElement" id="recibirMsg">Habilitar Mensajes Privados</div>
  				<div class="listElement" id="NoRecibirMsg" hidden >Deshabilitar Mensajes Privados</div>
  			{/if}
	</div>
	<div id="panelDiv" class="menu_element">{$nombreUsuario} </div>	
	<div id="logoutDiv" class="menu_element" >Logout</div>

	<div id="bandeja" class="menu_element">
		<img src="images/carta.png">
		<div id="numerito">{$numMensajes}</div>
	</div>
{else}
	<div id="altaDiv" class="menu_element">Alta</div>
	<div id="loginDiv" class="menu_element">Login</div>
{/if}
{if $nivelAcceso > 1 && !$IN_ADMIN}
<div id="adminDiv" class="menu_element">Admin</div>
{/if}
<div class="barraBusqueda">
		<input type="text" id="palabra_clave" name="palabra_clave">
		<input type="button" id="buscar" value="Buscar">
	</div>

</div>