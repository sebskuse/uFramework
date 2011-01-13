<?php
// Define system-wide error reporting
error_reporting(E_ALL);

define("SYSTEM_BASE", realpath( dirname(__FILE__) . "/../../") );

define("SYSTEM_DIR", SYSTEM_BASE);

define('SYS_DEFAULTCNTRLR', 'home');

define('SYS_ROOTDIR', realpath(SYSTEM_BASE . "../") );
define('SYS_CLASSDIR', SYS_ROOTDIR . "app/system/classes/");
define('SYS_SYSDIR', SYS_ROOTDIR . "app/system/");
define('SYS_ASSETDIR', SYS_ROOTDIR . "app/assets/");

define('BASEURL', 'http://realise.devx.co.uk/');
define('SYS_INCLUDEURL', 'http://realise.devx.co.uk/');

define('SYS_INCLUDEPATHS', serialize(array(
	SYS_CLASSDIR,
	SYS_ASSETDIR . "classes/",
	SYSTEM_DIR  . "system/"
)));

define('SYS_RESTFORMATS', serialize(array(
	"xml",
	"json"
)));

?>