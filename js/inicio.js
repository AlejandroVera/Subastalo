function init() {

	$(".resultadoInicio").each(function() {
		var url = $(this).data("url");
		$(this).click(function() {
			document.location.href = url;
		});
	});

	//Inicializar slider
	$('#slider').unslider({
		speed : 500, //  The speed to animate each slide (in milliseconds)
		delay : 3000, //  The delay between slide animations (in milliseconds)
		complete : function() {
		}, //  A function that gets called after every slide animation
		keys : true, //  Enable keyboard (left, right) arrow shortcuts
		dots : true, //  Display dot navigation
		fluid : false //  Support responsive design. May break non-responsive designs
	});

}