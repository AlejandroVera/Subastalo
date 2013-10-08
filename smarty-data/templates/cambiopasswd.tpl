{include file="header.tpl" title="Modificar contraseña" scripts=$scripts}
<form id=cambiarPass>

	<div class="entradaCambio">
		<div class="textoEntradaAlta">Hola {$nombre}, para cambiar la contraseña:</div>
		<div class="textoEntradaAlta">introduzca contraseña su antigua:</div>
		<div class="valorEntradaTabla">
			<input type="password" name="oldpassword">
		</div>
	</div>
	<div class="entradaCambio">
		<div class="textoEntradaAlta">escriba contraseña nueva:</div>
		<div class="valorEntradaTabla">
			<input type="password" name="password">
		</div>
	</div>
	<div class="entradaCambio">
		<div class="textoEntradaAlta">repita contraseña nueva:</div>
		<div class="valorEntradaTabla">
			<input type="password" name="pass_check">
		</div>
	</div>
	<input type="submit" value="¡Cambiar!">
</form>
{include file="footer.tpl"}