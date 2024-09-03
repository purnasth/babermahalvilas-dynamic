<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

define('HOMEPAGE', 1); // Track homepage.
define('MAIN_PAGE', 1);// Track Article page.
define('JCMSTYPE', 0); // Track Current site language.
// require_once('blog/wp-blog-header.php');
require_once("includes/initialize.php");

$currentTemplate	= Config::getCurrentTemplate('template');
$jVars 				= array();
$template 			= "template/{$currentTemplate}/index.html";

require_once('views/modules.php');

template($template, $jVars, $currentTemplate);

?>