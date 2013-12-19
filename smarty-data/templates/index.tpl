{include file="header.tpl" title="Pagina principal" scripts=$scripts}
{if isset($idUsuario)}
<script type="text/javascript">
	conectar({$idUsuario});
</script>
{/if}
<iframe src="./inicio.php" id="marco" height="100%" width="100%"> Lo sentimos, 
su navegador no soporta iframe. Le recomendamos Mozilla Firefox para visualizar esta web</iframe> 

{include file="footer.tpl"}
