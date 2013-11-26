{include file="header.tpl" title="Edición de usuario" scripts=$scripts}
{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN aceptaMsg=$aceptaMsg}
<div id="divEdicion">
<form id="editarPerfil" enctype="multipart/form-data">
	<div class="fotos">
		<div class="textoEntradaEdicion">Foto de Perfil</div>
		<div class="valorEntradaTabla">
			<input id="selectorFotos" name="fotos[]" type="file" multiple="true" accept="image/*" />
			<div id="imagenes"></div>
		</div>
		</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Nombre</div>
		<div class="valorEntradaTabla">
			<input type="text" name="nombre" class="campoTexto" value ="{$res.nombre}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Apellidos</div>
		<div class="valorEntradaTabla">
			<input type="text" name="apellidos" class="campoTexto" value ="{$res.apellidos}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Dirección</div>
		<div class="valorEntradaTabla">
			<input type="text" name="direccion" class="campoTexto" value ="{$res.direccion}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Código postal</div>
		<div class="valorEntradaTabla">
			<input type="text" name="cod_postal" class="campoTexto" value ="{$res.cod_postal}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Ciudad</div>
		<div class="valorEntradaTabla">
			<input type="text" name="ciudad" class="campoTexto" value ="{$res.ciudad}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Pais</div>
		<div class="valorEntradaTabla">
			<input type="text" name="pais" class="campoTexto" value ="{$res.pais}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Fecha nacimiento</div>
		<div class="valorEntradaTabla">
			<input type="date" name="fecha_nacimiento" class="campoTexto" value ={$res.fecha_nacimiento}>
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Teléfono</div>
		<div class="valorEntradaTabla">
			<input type="text" name="telefono" class="campoTexto" value ={$res.telefono}>
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Email</div>
		<div class="valorEntradaTabla">
			<input type="email" name="email" class="campoTexto" value ={$res.email}>
		</div>
	</div>

		<div class="textoEntradaEdicion"><br>Elija de la lista los productos que le interesen:</div>
		<div>
		{foreach key=key item=item from=$lista}
			{if $item == 1}
				<div>
					<input type="checkbox" name="{$key}" checked> 
					{$key}
				</div>
			{else}
				<div>
				<input type="checkbox" name="{$key}"> 
				{$key}
				</div>
			{/if}
			
		{/foreach}
		</div>	

	<div>
		<div class="textoEntradaEdicion"><br>Escriba aquí los productos que le interesan adquirir:</div>
		<div class="entradaEdicion">
			<textarea name="productosInteresados" rows="10" cols="50" class="textArea">{$res.productosInteresados}</textarea>
		</div>
	</div>
	<div style="text-align:center">
		<input type="submit" value="¡Actualizar!" class="redButton"><button class="redButton" type="button" id="cancelar">Cancelar</button>
	</div>
</form>
</div>

{include file="footer.tpl"}
