{include file="header.tpl" title="Modificar contraseña" scripts=$scripts IS_CONTENT=false}
<div id="divCambio">
<form id=cambiarPass>

	<div class="entradaCambio">
		<div class="textoEntradaCambio">Hola {$nombre}, para cambiar la contraseña:</div>
		<div class="textoEntradaCambio">Introduzca contraseña su antigua:</div>
		<div class="valorEntradaTabla">
			<input type="password" name="oldpassword">
		</div>
	</div>
	<div class="entradaCambio">
		<div class="textoEntradaCambio">Escriba contraseña nueva:</div>
		<div class="valorEntradaTabla">
			<input type="password" name="password">
		</div>
	</div>
	<div class="entradaCambio">
		<div class="textoEntradaCambio">Repita contraseña nueva:</div>
		<div class="valorEntradaTabla">
			<input type="password" name="pass_check">
		</div>
	</div>
	<input type="submit" value="¡Cambiar!" class="redButton">
</form>
</div>
{include file="footer.tpl"}