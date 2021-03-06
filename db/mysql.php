<?php

function doquery($query, $table, $fetch = false) {
    
    global $debug, $link2;
    
    if (!isset($link2)) {
	   mysql_internal_connect();
    }

    //Cargamos el array con los datos de coneción
    require(IS2_ROOT_PATH . 'db/dbConfig.php');
    
    $sql = str_replace("{{table}}", $dbsettings["prefix"] . $table, $query);

    $sqlquery = mysqli_query($link2, $sql) or
	    $debug->error(mysqli_error($link2) . "<br />$sql<br />", "SQL Error");
    
    //Se borra la array para liberar algo de memoria
    unset($dbsettings); 

    global $numqueries, $debug;
    $numqueries++;
    $debug->add("<tr><th>Query $numqueries: </th><th>$query</th><th>$table</th><th>$fetch</th></tr>");

    if ($fetch) { //hace el fetch y regresa $sqlrow
    	$sqlrow = mysqli_fetch_array($sqlquery);
    	return $sqlrow;
    } else { //devuelve el $sqlquery ("sin fetch")
        return $sqlquery;
    }
}


function mysql_internal_connect(){
    
    global $link2, $debug;
    
    //Load dbsettings array with connection info
    require_once(IS2_ROOT_PATH . 'db/dbConfig.php');
    
    $link2 = mysqli_init();
    if (!$link2->real_connect($dbsettings["server"], $dbsettings["user"], $dbsettings["pass"], $dbsettings["name"], $dbsettings['port'])) {
        $debug->error('Error de conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error(), "SQL Error");
    }
    
    mysqli_query($link2, "set character set utf8");
    mysqli_query($link2, "set names utf8");
}

function secure_text_query($text){
    global $link2;
    
    if(!isset($link2)){
	   mysql_internal_connect();
    }
    return mysqli_real_escape_string($link2, $text);
}

function mysqlLastInsertedId(){
    global $link2;
    
    return mysqli_insert_id($link2);
}

?>
