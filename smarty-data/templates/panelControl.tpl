{include file="header.tpl" title="Busqueda de producto" scripts=$scripts}
        <div class="seccionControl">
			<a href=>Cambio de contraseña</a>
		</div>
		<div class="seccionControl">
			<a href={urlHistorialSubastas}>Historial de subastas y compras</a>
		</div>
		<div class="seccionControl">
			<a href={urlCambioDePerfil}>Editar su perfil</a>
		</div>
		<div class="seccionControl">
			<button title="mensaje" id="botonCont">
				Contactar con la Administración
			</button>
			<div id="popuT">
				<textarea id="cuerpoT" rows="4" cols="40">cuerpo del mensaje</textarea>
				<button title="enviarT" id="botonEnv" onclick="contactar({$usuarioLogueado})">
					Enviar
				</button>
			</div>
		</div>
		<div class="seccionControl">
			<div class="texto">Mensajes privados</div>
			<input type="checkbox" name="mensajes_activados"/>
		</div>
{include file="footer.tpl"}