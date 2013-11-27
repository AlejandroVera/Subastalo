{include file="header.tpl" title="Alta de productos" scripts=$scripts IS_CONTENT=false}
{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN aceptaMsg=$aceptaMsg}
<div class="globalContainer">
<form id="formularioAltaProducto" enctype="multipart/form-data">
	<h1>Alta de un producto</h1>
	<div class="separador"></div>
	<div class="entradaAlta centered">
		<div class="textoEntradaAlta">Nombre</div>
		<div class="valorEntradaTabla">
			<input type="text" name="nombre">
		</div>
	</div>
	<div class="entradaAlta centered">
		<div class="textoEntradaAlta">Descripción</div>
		<div class="valorEntradaTabla">
			<textarea name="descripcion"></textarea>
		</div>
	</div>
	<div class="entradaAlta centered">
		<div class="textoEntradaAlta">Categoría</div>
		<div class="valorEntradaTabla">
			<input type="text" name="categoria">
		</div>
	</div>
	<div class="separador"></div>
	<div class="fotos centered">
		<div class="textoEntradaAlta">Fotos</div>
		<div class="">
			<input id="selectorFotos" name="fotos[]" type="file" multiple="true" accept="image/*" />
			<div id="imagenes"></div>
		</div>
	</div>
	<div class="separador"></div>
	<div class="entradaAlta">
		<div class="textoEntradaAlta">Características</div>
		<div class="valorEntradaTabla">
			<table id="contCaract">
				<tbody>
					<tr>
						<th>Nombre</th>
						<th>Valor</th>
					</tr>
					<tr class="caracteristica">
						<td><input type="text" name="nombreCaract[1]"></td>
						<td><input type="text" name="valorCaract[1]"></td>
					</tr>
				</tbody>
			</table>
			<span id="addCaract" class="redButton">Añadir característica +</span>
		</div>
	</div>
	<div class="separador"></div>
	<div class="entradaAlta centered">
		<div class="textoEntradaAlta ">Tipo de producto</div>
		<div class="valorEntradaTabla">
			<select id="selectorTipo" name="tipo">
				<option value="none">Seleccionar tipo</option>
				<option value="subasta">Subasta</option>
			</select>
		</div>
	</div>
	<div class="entradaAlta elegible subasta centered" style="display: none;">
		<div class="textoEntradaAlta">Tiempo de inicio</div>
		<div class="valorEntradaTabla">
			<input id="selectorInicio" type="text" name="comienzo">
		</div>
	</div>
	<div class="entradaAlta elegible subasta centered" style="display: none;">
		<div class="textoEntradaAlta">Duración (minutos)</div>
		<div class="valorEntradaTabla">
			<input type="number" name="duracion">
		</div>
	</div>
	<input type="submit" value="Dar de alta" class="redButton">
</form>
{include file="footer.tpl"}