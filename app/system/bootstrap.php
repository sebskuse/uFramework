<?php
// Bootstrapper for InStep application

// Bring in configuration
require_once("core/conf.php");

// Set the include paths.
$includePath = get_include_path() . ":" . implode(":", unserialize(SYS_INCLUDEPATHS));
set_include_path($includePath);

// Get the autoload functions
require_once("../assets/configuration/init.php");
?>