{include file="header.tpl" title="Edición de usuario" scripts=$scripts}
<form id="editarPerfil" enctype="multipart/form-data">
	<div class="entradaEdicion">
		<div class="textoEntradaEdicion">Foto de Perfil</div>
		<div class="valorEntradaTabla">
			<input id="selectorFotos" name="fotos[]" type="file" multiple="true" accept="image/*" />
			<div id="imagenes"></div>
		</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Nombre</div>
		<div class="valorEntradaTabla">
			<input type="text" name="nombre" value ="{$res.nombre}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Apellidos</div>
		<div class="valorEntradaTabla">
			<input type="text" name="apellidos" value ="{$res.apellidos}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Dirección</div>
		<div class="valorEntradaTabla">
			<input type="text" name="direccion" value ="{$res.direccion}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Código postal</div>
		<div class="valorEntradaTabla">
			<input type="text" name="cod_postal" value ="{$res.cod_postal}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Ciudad</div>
		<div class="valorEntradaTabla">
			<input type="text" name="ciudad" value ="{$res.ciudad}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Pais</div>
		<div class="valorEntradaTabla">
			<input type="text" name="pais" value ="{$res.pais}">
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Fecha nacimiento</div>
		<div class="valorEntradaTabla">
			<input type="date" name="fecha_nacimiento" value ={$res.fecha_nacimiento}>
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Teléfono</div>
		<div class="valorEntradaTabla">
			<input type="text" name="telefono" value ={$res.telefono}>
		</div>
	</div>
	<div class="entradaEdicion">
		<div class="textoentradaEdicion">Email</div>
		<div class="valorEntradaTabla">
			<input type="email" name="email" value ={$res.email}>
		</div>
	</div>
	</div>
		<div class="textoentradaEdicion"><br>Elija de la lista los productos que le interesen:</div>
		<div class="entradaEdicion">
		{foreach key=key item=item from=$lista}
			{if $item == 1}
				<div class="valorEntradaTabla">
					<input type="checkbox" name="{$key}" checked> 
					{$key}
				</div>
			{else}
				<div class="valorEntradaTabla">
				<input type="checkbox" name="{$key}"> 
				{$key}
				</div>
			{/if}
			
		{/foreach}
		</div>
	</div>

	<div>
		<div class="textoentradaEdicion"><br>Escriba aquí los productos que le interesan adquirir:</div>
		<div class="entradaEdicion">
			<textarea name="productosInteresados" rows="10" cols="50">{$res.productosInteresados}</textarea>
		</div>
	</div>

	<input type="submit" value="¡Actualizar!"><button type="button" id="cancelar">Cancelar</button>
</form>


{include file="footer.tpl"}
