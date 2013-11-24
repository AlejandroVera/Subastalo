{include file="header.tpl" title="Alta de usuario" scripts=$scripts css=$css}

{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN}

<div id='login-box' class='login-popup'>
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
			<input id ="accederLogin" type="submit" value="Acceder" class="redButton">
			<p><a class="link" href="recuperacion.php">¿Has olvidado tu contraseña y/o usuario?</a></p>
			<p><a class="link" href="alta.php">¿Aun no estas registrado?</a></p>
		</fieldset>
	</form>
</div>

{include file="footer.tpl"}
