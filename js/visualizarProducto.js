function init(){
	var id=getParameterByName("id");
	countdown(1,"visualizarProducto.php?terminado&id="+id);
	$("#pujar").click(function(){
		$(function() {
			$( "#dialog" ).dialog();
			$("#Popup").load('confirmarPuja.php?idProducto='+id);
		});
		
		return false;
	});
}


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

/* 
* @Necesita un input que sea <input type="hidden" value=tiempo_hasta_finalizacion(seg) name=la_id_donde_quieres _que_aparezca class="countdown">
*
* function countdown(showDays,red,redTime)
* showDays: (1 || 0) 1-> muestra dias que faltan, 0 -> solo horas
* red: (string) direccion a la que quieres que vaya cuando llegue a 0
* redTime: lapse de tiempo, una vez finalizado, para que redireccione
*/
function countdown(showDays,red,redTime){
	//para que no se superpongan las llamadas a las funciones
	if(typeof(ssid)!=='undefined')
		window.clearTimeout(ssid);
	
	//variables
	var mins = 0;
	var horas = 0;
	var dias = 0;
	var date = new Date();
	var seconds = date.getTime()/1000;
	conDias = showDays;
	if(typeof(conDias) === 'undefined'){
		conDias = false;
	}	
	
	redirect = red;
	if(typeof(redirect) === 'undefined'){
		redirect = false;
	}	
	
	timeRed = redTime;
	if(typeof(timeRed) === 'undefined'){
		timeRed = 450;
	}	

	//cuenta regresiva
	todos = $(".countdown");
	for(i=0;i<todos.length;i++){
		endTime = todos[i].value;
		id = todos[i].name;
		sobran = Math.ceil((endTime - seconds));
		if ( sobran <= 0 ) {
			$('#'+id)[0].innerHTML = "0:00:00";
			if(redirect){
				window.setTimeout('document.location.href="'+redirect+'";', timeRed);
			}
		} else {
			if ( sobran > 59) {
				mins = Math.floor( sobran / 60);
				sobran = sobran - mins * 60;
			}else
				mins = 0;
				
			if ( mins > 59) {
				horas = Math.floor( mins / 60);
				mins = mins - horas * 60;
			}else
				horas = 0;
				
			if(conDias){
				if(horas > 24) {
					dias = Math.floor( horas / 24);
					horas = horas - dias * 24;
				}
			}
			if ( sobran < 10 ) {
				sobran = "0" + sobran;
			}
			if ( mins < 10 ) {
				mins = "0" + mins;
			}
			if(conDias){
				if(dias > 0)
					$('#'+id)[0].innerHTML = dias + "d " + horas + ":" + mins + ":" + sobran;
				else
					$('#'+id)[0].innerHTML = horas + ":" + mins + ":" + sobran;					
			}else{
				$('#'+id)[0].innerHTML = horas + ":" + mins + ":" + sobran;
			}

		}
	}
	ssid = window.setTimeout("countdown(conDias,redirect,timeRed)", 1000);
}