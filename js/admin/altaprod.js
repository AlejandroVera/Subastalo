function init(){

	arrayImagenes = [];
	
	$("#formularioAltaProducto").submit(function(e){
		sendForm(e);
		return false;
	});
	
	$("#selectorFotos").change(function(){
	    handleSelectedImage(this);
	});
}

function sendForm(e) {
	 
    var formObj = $("#formularioAltaProducto");
    var formURL = "altaprod.php?create=subasta";
    
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
	    },
		error: function(jqXHR, textStatus, errorThrown)
	    {
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
                img.attr("id", "imagen"+this.x);
                img.attr("alt", "your image");
                img.attr("height", "100px");
                img.attr("width", "100px");
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