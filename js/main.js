/**Script principal, pertenece a la página que contiene el iframe*/
$(document).ready(function() {
	$("#marco").attr("src", "./inicio.php");

	$("#loginDiv").click(function() {
		$("#marco").attr("src", "./login.php");
	});

	$("#altaDiv").click(function() {
		$("#marco").attr("src", "./alta.php");
	});

});

function putLogoutButton() {
	$("#loginDiv").replaceWith("<div id=\"logoutDiv\" class=\"menu_element\" >Logout</div>");
	$("#logoutDiv").click(function() {
		$("#marco").attr("src", "./logout.php");
	});
}

function putLoginButton() {
	$("#logoutDiv").replaceWith("<div id=\"loginDiv\" class=\"menu_element\" >Login</div>");
	$("#loginDiv").click(function() {
		$("#marco").attr("src", "./login.php");
	});
}