{include file="header.tpl" title="Alta de usuario" scripts=$scripts}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN}

<div class='marcoSignIn'>
	<a href='#login-box' class='login-window'>"autentificación"</a>
</div>
<div id='login-box' class='login-popup'>
	<a href='#' class='close'>
		<img src="images/close_pop.png" class="btn_close" title="Close_window" alt="close" />
	</a>
	<form id="login" name='loginform' class='signin'>
		<fieldset class='box'>
			<div class="entradaLogin">
				<div class="textoEntradaLogin">Email</div>
				<div class="valorEntradaTabla">
					<input type="text" name="email">
				</div>
			</div>
			<div class="entradaLogin">
				<div class="textoEntradaLogin">Contraseña</div>
				<div class="valorEntradaTabla">
					<input type="password" name="password">
				</div>
			</div>
			<input id ="accederLogin" type="submit" value="Acceder!">
			<p><a class='forgot' href="recuperacion.php">¿Has olvidado tu contraseña y/o usuario?</a></p>
			<p><a class='reg' href="alta.php">¿Aun no estas registrado?</a></p>
		</fieldset>
	</form>
</div>

{include file="footer.tpl"}
