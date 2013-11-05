{include file="header.tpl" title="Alta de productos" scripts=$scripts}
<form id="formularioAltaProducto" enctype="multipart/form-data">
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Nombre</div>
		<div class="valorEntradaTabla">
			<input type="text" name="nombre">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Descripción</div>
		<div class="valorEntradaTabla">
			<textarea name="descripcion"></textarea>
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Fotos</div>
		<div class="valorEntradaTabla">
			<input id="selectorFotos" name="fotos[]" type="file" multiple="true" accept="image/*" />
			<div id="imagenes"></div>
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Categoría</div>
		<div class="valorEntradaTabla">
			<input type="text" name="categoria">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Otros atributos</div>
		<div class="valorEntradaTabla">
			<input type="text" name="ciudad">
		</div>
	</div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Tipo de entrada</div>
		<div class="valorEntradaTabla">
			<select name="tipo">
				<option value="none">Seleccionar tipo</option>
				<option value="subasta">Subasta</option>
			</select>
		</div>
	</div>
	<input type="submit" value="Dar de alta">
</form>
{include file="footer.tpl"}