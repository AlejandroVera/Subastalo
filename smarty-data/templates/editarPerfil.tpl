{include file="header.tpl" title="Edición de usuario" scripts=$scripts}
<form id="editarPerfil">
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
		<div class="textoentradaEdicion">Elija de la lista los productos que le interesen:</div>
		<div class="entradaEdicion">
		{foreach key=key item=item from=$lista}
			<div class="valorEntradaTabla">
				<input type="checkbox" name="lista[]" value="{$key}"> 
				{$key}
			</div>
		{/foreach}
		</div>
	</div>
	
	
	<input type="submit" value="¡Actualizar!">
</form>
{include file="footer.tpl"}
