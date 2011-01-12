<?php
// Bootstrapper for InStep application

// Bring in configuration
require_once("system/core/conf.php");

// Set the include paths.
$includePath = get_include_path() . ":" . implode(":", unserialize(SYS_INCLUDEPATHS));
set_include_path($includePath);

// Get the autoload functions
require_once("assets/configuration/autoload.php");

// Bring in InFolio conf
//require_once(SYSTEM_CONF);

// Define the version
define('SYS_VER', "0.1.051");

?>