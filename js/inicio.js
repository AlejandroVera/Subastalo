$(document).ready(function() {

	$("#loginDiv").click(function() {

		window.parent.$("#marco").attr("src", "./login.php");
	});
	
	$("#logoutDiv").click(function() {

		window.parent.$("#marco").attr("src", "./logout.php");
	});
	
	$("#altaDiv").click(function() {
		window.parent.$("#marco").attr("src", "./alta.php");
	});

	$("#adminDiv").click(function() {
		$("#marco").attr("src", "./admin/index.php");
	});
	
	$("#buscar").click(function() {
		var pal = $("#palabra_clave")[0].value;		
		window.parent.$("#marco").attr("src", "./busqueda.php?palabra_clave=" + pal);
	});
});
