<?php

function getRuntimeObjects(){
	
	$objects = array();
	
	return $objects;
}

// This function auto loads classes.
function __autoload($class_name) {

	if(stristr($class_name, 'PEAR') !== false){
		$path = str_replace("_", "/", $class_name);
		include_once($class_name . ".php");
	} else {	
		include_once($class_name . ".class.php");
	
		if (!class_exists($class_name, false)) {
	   		trigger_error("Unable to load class: $class_name", E_USER_WARNING);
	  	}
	}

}

?>