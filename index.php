<?php


define('FM_DEBUG', true);
/* FM Debug
if(defined('FM_DEBUG') && FM_DEBUG == true) 
{
echo "<pre>";
print_r("File: ".__FILE__);
echo "<br />";
print_r("Line: ".__LINE__);
echo "<br />";        
print_r("Inside ".__METHOD__." of class ".__CLASS__); 
echo "<br />\$APPLICATION_PATH: <br />";
print_r(APPLICATION_PATH);
echo "<br />";
echo "<br />";
echo "</pre>"; 
}
*/
if(defined('FM_DEBUG') && FM_DEBUG == true) 
{
	define('WP_MEMORY_LIMIT', '-1');
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    //opcache_reset();
}


if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


require_once(ABSPATH.'config.php');
require_once(ABSPATH.'/lib/prices.php');
require_once(ABSPATH.'controller/app.php');


$app = new App($_REQUEST);
$app->process_action();
echo $app->display();