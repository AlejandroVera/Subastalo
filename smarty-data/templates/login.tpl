{include file="header.tpl" title="Alta de usuario"}
<form id="login" method="POST" action="login.php?validate">
	<div class="entradaLogin">
		<div class="textoEntradaLogin">Email</div>
		<div class="valorEntradaTabla">
			<input type="text" name="email">
		</div>
	</div>
	<div class="entradaLogin">
		<div class="textoEntradaLogin">Contraseña</div>
		<div class="valorEntradaTabla">
			<input type="text" name="password">
		</div>
	</div>
	
	<input type="submit" value="Acceder!">
</form>
{include file="footer.tpl"}
