{include file="header.tpl" title="Alta de usuario" scripts=$scripts}

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

<form id="formularioAlta">
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Nombre usuario</div>
		<div class="valorEntradaTabla">
			<input type="text" name="username">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Nombre</div>
		<div class="valorEntradaTabla">
			<input type="text" name="nombre">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Apellidos</div>
		<div class="valorEntradaTabla">
			<input type="text" name="apellidos">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Dirección</div>
		<div class="valorEntradaTabla">
			<input type="text" name="direccion">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Código postal</div>
		<div class="valorEntradaTabla">
			<input type="text" name="cod_postal">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Ciudad</div>
		<div class="valorEntradaTabla">
			<input type="text" name="ciudad">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Pais</div>
		<div class="valorEntradaTabla">
			<input type="text" name="pais">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Fecha nacimiento</div>
		<div class="valorEntradaTabla">
			<input type="date" name="fecha_nacimiento">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Teléfono</div>
		<div class="valorEntradaTabla">
			<input type="text" name="telefono">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Email</div>
		<div class="valorEntradaTabla">
			<input type="email" name="email">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Comprobar email</div>
		<div class="valorEntradaTabla">
			<input type="email" name="email_check">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Contraseña</div>
		<div class="valorEntradaTabla">
			<input type="password" name="password">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Comprobar contraseña</div>
		<div class="valorEntradaTabla">
			<input type="password" name="pass_check">
		</div>
	</div>
	<input type="submit" value="¡Regístrame!">
</form>
{include file="footer.tpl"}
