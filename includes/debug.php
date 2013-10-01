<?php

if (!defined('INSIDE')) {
    die("Incorrect access.");
}

class debug {

    var $log, $numqueries, $secure_fleet, $spent_time;

    function debug() {
    	$this->vars = $this->log = '';
    	$this->numqueries = 0;
    	$this->spent_time = microtime(true);
    }

    function add($mes) {
    	$this->log .= $mes;
    	$this->numqueries++;
    }

    function echo_log() {
    	echo "<br><table><tr><td class=k colspan=4>Debug Log: <b>Tiempo de ejecución: " .
    	(microtime(true) - $this->spent_time) . " s. &nbsp;&nbsp;Memoria total máxima: " . (memory_get_peak_usage() / 1024) . " KB</b></td></tr>" . $this->log . "</table>";
    }

    function error($message, $title) {

    	global $link2, $web_config;
    
    	if ($web_config['debug']) {
    	    echo "<h2>$title</h2><br><font color=red>$message</font><br><hr>";
    	    echo "<table>" . $this->log . "</table>";
    	}
    
    	include(IS2_ROOT_PATH . 'config.php');
    
    	/*
    	  $query = "INSERT INTO {{table}} SET
    	  `error_sender` = '{$user['id']}' ,
    	  `error_time` = '" . time() . "' ,
    	  `error_type` = '{$title}' ,
    	  `error_text` = '" . mysql_real_escape_string($message) . "' ,
    	  `error_page` = '" . mysql_real_escape_string($_SERVER['PHP_SELF']) . "' ,
    	  `error_input` = '" . mysql_real_escape_string('GET: ' . var_export($_GET, true) . "\n" . ' POST: ' . var_export($_POST, true)) . "';";
    
    	  $sqlquery = mysql_query(str_replace("{{table}}", $dbsettings["prefix"] . 'errors', $query)) or die('error fatal');
    
    	  $query = "explain select * from {{table}}";
    	  $q = mysql_fetch_array(mysql_query(str_replace("{{table}}", $dbsettings["prefix"] .
    	  'errors', $query))) or die('ERROR FATAL. Es posible que falte alguna columna necesaria en la BD. Mira el log de errores. ');
    	 */
    
    	echo "<b>Se ha producido un error. Momento del error: " . time() . "</b>";
    
    	mysqli_close($link2);
    	die();
    }

}

?>
