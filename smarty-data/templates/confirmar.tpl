{include file="header.tpl" title="Confirmación de cuenta"}
<form action="confirmar.php?confirmar" method="POST">
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Email</div>
		<div class="valorEntradaTabla">
			<input type="email" name="email">
		</div>
	</div>
		<div class="entradaAlta">
		<div class="textoEntradaAlta">Contraseña</div>
		<div class="valorEntradaTabla">
			<input type="password" name="password">
		</div>
	</div>
	<input type="submit" value="Confirmar cuenta">
</form>
{include file="footer.tpl"}