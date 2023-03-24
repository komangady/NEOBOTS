<?php
/**
	Initialize
**/
require_once('globals/config.php');
DEFINE("PATH_CLASSES",'globals/class/');
DEFINE("PATH_CLASSESEXCEL",'globals/classesexcel/');
DEFINE("PATH_INCLUDES",'globals/inc/');
DEFINE("PATH_CLASSESPDF",'globals/html2pdf/');
DEFINE("PATH_FUNCTIONS",'globals/functions/');
DEFINE("PATH_LANGUAGES",'globals/lang/');
DEFINE("PATH_JS",'js/');
DEFINE("PATH_LIBS",'libs/');
DEFINE("PATH_SECURIMAGE",'globals/securimage/');

/** System Settings **/;
DEFINE("SITE_NAME",'SDM STPBI');
/******************************
Modules Proses
*******************************/
define('MODULES_DIR', DOCROOT.$subdir.$mdls);
$defaultModules = 'v.1/';
$selected_modules = $defaultModules;
//echo MODULES_DIR.$selected_modules;
if(!@is_dir(MODULES_DIR.$selected_modules)) {
	echo 'Invalid Configuration! Load Modules';
	exit();
}

DEFINE("PATH_MODULES", $mdls.$selected_modules);
require_once('includes.php');
/******************************
Template Ouptput
*******************************/
define('TEMPLATE_DIR', DOCROOT.$subdir.$tmpl);
$defaultTheme = 'v.1.1/';
$selected_theme = $defaultTheme;
if(!@is_dir(TEMPLATE_DIR.$selected_theme)) {
	echo 'Invalid Configuration! Load Templates';
	exit();
}
define('load_theme', TEMPLATE_DIR.$selected_theme);

define("js_root_insert", $protocol.$url.$subdir.$js);
define("css_root_insert", $protocol.$url.$subdir.$css);

//define('exceltmpl', DOCROOT.'/tempelateexcel/');
?>
