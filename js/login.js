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
	window.parent.$("#marco").attr("src", "./admin/index.php");
	});
});
