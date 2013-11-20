{include file="header.tpl" title="Visualizar producto" scripts=$scripts}


<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
	   {foreach from=$res.imagenes item=imagen}
	    <img src="images/{$imagen}" alt="" data-transition="slideInLeft"/>
	   {/foreach}
	</div>
</div>	

<script type="text/javascript">

$('#slider').nivoSlider({
    effect: 'random',               // Specify sets like: 'fold,fade,sliceDown'
    slices: 15,                     // For slice animations
    boxCols: 8,                     // For box animations
    boxRows: 4,                     // For box animations
    animSpeed: 500,                 // Slide transition speed
    pauseTime: 8000,                // How long each slide will show
    startSlide: 0,                  // Set starting Slide (0 index)
    directionNav: true,             // Next & Prev navigation
    controlNav: true,               // 1,2,3... navigation
    controlNavThumbs: false,        // Use thumbnails for Control Nav
    pauseOnHover: true,             // Stop animation while hovering
    manualAdvance: false,           // Force manual transitions
    prevText: 'Prev',               // Prev directionNav text
    nextText: 'Next',               // Next directionNav text
    randomStart: false,             // Start on a random slide
    beforeChange: function(){},     // Triggers before a slide transition
    afterChange: function(){},      // Triggers after a slide transition
    slideshowEnd: function(){},     // Triggers after all slides have been shown
    lastSlide: function(){},        // Triggers when last slide is shown
    afterLoad: function(){}         // Triggers when slider has loaded
});


</script>
	

<div id="Datos">
	<div id="nombre">
		{$res.nombre}
	</div>
	
	<div id="pujaTerminada">Puja Terminada</div>

	<div id="dialog">
	<div id="Popup"></div>
	</div>
	
	<div id="puntos">
		Mejor puja: {$res.puntos} puntos --> Ganador: ({$res.usuario})
	</div>
</div>

<div id="Descripcion">
	<br>Descripción:<br>
	{$res.descripcion}
</div>


{include file="footer.tpl"}