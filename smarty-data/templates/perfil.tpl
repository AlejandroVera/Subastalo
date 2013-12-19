{include file="header.tpl" title="Pagina principal" USUARIO_LOGUEADO=$USUARIO_LOGUEADO numMensajes=$numMensajes}
<div id="sombra" style="display:none"></div>
<div id="popupMsg" style="display:none">
	<div class="titulo">Mensaje privado</div>
	<textarea id="asuntoMsg" rows="1" class="campoTexto" cols="40">Asunto</textarea>
	<textarea id="cuerpoMsg" rows="4" class="campoTexto" cols="40">Escriba aquí su mensaje</textarea>
	<button title="enviar" id="buttonEnv" class="redButton">
		Enviar
	</button>
	<button title="Cancelar" id="buttonCan" class="redButton">
		Cancelar
	</button>
</div>
{include file ="barra.tpl" nivelAcceso=$nivelAcceso IN_ADMIN=$IN_ADMIN nombreUsuario=$nombreUsuario aceptaMsg=$aceptaMsg}



<div id="contenedor">


<div id="datos">
<div class="imagenPerfil">
	{if $res.imagenPerfil==""}
		<img src="images/noImage.jpg"> 
	{else}
		<img src="images/uploaded/{$res.imagenPerfil}"> 
	{/if}
</div>
<div id="datosPersonales">
<div class="entradaEdicion">
	<div class="enunciado">Usuario</div> <div class="entradaDatos">{$res.username} </div>
</div>
<div class="entradaEdicion">
	<div class="enunciado">Teléfono</div><div class="entradaDatos">{$res.telefono}</div>
</div>
<div class="entradaEdicion">
	<div class="enunciado">Email</div><div class="entradaDatos">{$res.email}</div>
</div>
</div>
{if $aceptaMsg==1 && $idPerfil != $usuarioLogueado && isset($USUARIO_LOGUEADO)}

<button title="mensaje" id="buttonMsg" class="redButton">
	Mensaje Privado
</button>

{/if}
</div>
<div class="tabla">
<div class="titulo bordeSuperior">Historial de pujas</div>
		<table id=historial class = "tablesorter">
			{$historial}			
		</table>				
	</div>	
</div>
{include file="footer.tpl"}