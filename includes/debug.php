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
    
    	echo "<b>Se ha producido un error. Momento del error: " . time() . "</b>";
    
    	mysqli_close($link2);
    	die();
    }

}

?>
