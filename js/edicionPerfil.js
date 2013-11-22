function init(){
	
	arrayImagenes = [];
	
	$("#selectorFotos").change(function(){
	    handleSelectedImage(this);
	});
	
	$("#editarPerfil").submit(function(e){
		editProfile(e);
		return false;
	});
	
	$("#cancelar").click(function(){
		window.location.href ="index.php";
	});
	
}


function editProfile(e) {
	 
    var formObj = $("#editarPerfil");
    var formURL = "editarPerfil.php?validate";
    
    //Cargamos toda la informacion del formulario HTML
    var formData = new FormData(formObj[0]);
    
    //Añadimos todas las imagenes del formulario
    for(var x = 0; x < arrayImagenes.length; x++){
    	formData.append("imagen"+x, arrayImagenes[x]);
    }
    
    //Enviamos los datos
    $.ajax({
        url: formURL,
    	type: 'POST',
        data:  formData,
    	mimeType:"multipart/form-data",
    	contentType: false,
        cache: false,
        processData:false,
	    success: function(data, textStatus, jqXHR)
	    {
	    	try{
		    	var data = JSON.parse(data);
				if (data.status == 200)
					messageAndRedirect(data.msg, data.url);
				else
					error(data.msg);
			}catch(e){
				alert("Error al enviar el formulario.");
				console.log(e);
			}
	    },
		error: function(jqXHR, textStatus, errorThrown)
	    {
	    	error("Se ha producido un error:"+textStatus);
	    }         
    });
    e.preventDefault(); //Prevent Default action.
}


function handleSelectedImage(input) {
    if (input.files) {

        for(var x = 0; x < input.files.length; x++){
        
        	var file = input.files[x];
        	
        	//Solo se pueden subir imagenes
        	if(!isImage(file.name))
        		continue;
        	
            var reader = new FileReader();
            
            //Creamos la visualización de la imagen
            var context = {x: x};
            reader.onload = function (e) {
                var imdiv = $('#imagenes');
                var img = $('<img id="dynamic">');
                img.addClass("prevImagen");
                img.attr("id", "imagen"+this.x);
                img.attr("alt", file.name);
                img.attr('src', e.target.result);
                imdiv.append(img);
            }.bind(context);
        
            reader.readAsDataURL(file);
            
            //Lo añadimos a la lista de imagenes a subir
            arrayImagenes.push(file);
        }
        
	 	//Reemplazamos el selector por uno nuevo para que no "guarde" las imagenes seleccionadas
	 	$(input).val('');
 	
    }
}

/**
 * Obtiene la extensión de un nombre de archivo
 */
function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

/**
 * Revisa un nombre archivo para saber si es una imagen o no
 */
function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
        //etc
        return true;
    }
    return false;
}

