/**Script principal, pertenece a la página que contiene el iframe*/
$(document).ready(function() {
	alert("solo se ejecuta al recargar el script");
	$("#loginDiv").click(function() {
		$("#marco").attr("src", "./login.php");
	});
	$("#logoutDiv").click(function() {
		$("#marco").attr("src", "http://www.google.com/");
	});
	$("#altaDiv").click(function() {
		$("#marco").attr("src", "./alta.php");
	});
	

}); 