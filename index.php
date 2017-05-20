<?php

session_start();
define('DS', DIRECTORY_SEPARATOR);
define('NO_SERVERNAME', 'localhost');
define('SECRET', "%^45345#£>2}]42re32/%^65d{£45654½5\$½&%%wdf");
$request_scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] . '://' : 'http://';
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : NO_SERVERNAME;
$server_port = isset($_SERVER['SERVER_PORT']) ? ':' .$_SERVER['SERVER_PORT'] : null;
$scriptName = $_SERVER['SERVER_NAME'];
if($_SERVER['SCRIPT_NAME'] != '/index.php')
{
    $base = preg_replace("/\\/\\index\\.php/", "",$_SERVER['SCRIPT_NAME']);
    define('BASE_URL', $request_scheme . $server_name  . $server_port . $base);

}
else
{
    define('BASE_URL', $request_scheme . $server_name . $server_port);
}
//define("TITLE", )
define('ROOT', realpath('.'));
define('STYLE_DIR', ROOT . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "style");
define('SCRIPT_DIR', ROOT . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "script");
define('CACHE', true);
define('CACHE_TIME', 5);
define('METHOD', $_SERVER['REQUEST_METHOD']);
$explode = @explode("?",$_SERVER['REQUEST_URI']);
if(!$explode)
{
    define('PATH', $_SERVER['REQUEST_URI']);

}
else
{
    define('PATH', $explode[0]);
}


$databases = glob("database/databases/*");

foreach ($databases as $database) {

    $connectionSettings = file_get_contents($database . "/connection.ntconfig");
    eval("\$connectionSettings = " . $connectionSettings );


    $databaseName = explode("/", $database);
    $databaseName = end($databaseName);

    $GLOBALS['Databases'][$databaseName] = new \PDO("mysql:host=". $connectionSettings['host'] .";dbname=" . $databaseName . ";charset=utf8", $connectionSettings['user'], $connectionSettings['pass']);

}


$routed = true;
$route = null;
$callRoute = array();
$middlewares = array();

require "vendor/autoload.php";

use \System\Session;
use \System\Response;
use \System\Cookie;
use \System\Request;
use \Libs\Languages;
use \Libs\Upload\Upload;
use duncan3dc\Laravel\Blade;
use duncan3dc\Laravel\BladeInstance;

Blade::addPath("resources/view");

define("DEFAULT_APP", 'production');
$default_lang = explode(',', apache_request_headers()['Accept-Language']);

/*
 * DEFAULT_LANG @define
*/
$default_lang = explode("-", $default_lang[0]);
if(file_exists('languages/'. $default_lang[0] . "_" . $default_lang[1] . ".nt"))
{
    define('DEFAULT_LANG', $default_lang[0] . "_" . $default_lang[1]);
    \Libs\Languages::setDefault(DEFAULT_LANG);

}
else
{
    define('DEFAULT_LANG', "tr_TR");
    if(file_exists('languages/'. DEFAULT_LANG . ".nt"))
    {
        \Libs\Languages::setDefault(DEFAULT_LANG);
    }
}

if(Cookie::issetCookie('lang'))
{
    Languages::setDefault(Cookie::get('lang'));
}

\System\Application::set("development", "/development", "ip", array("127.0.0.1", "::1"));
\System\Application::set("admin", "/admin", 'public', '');
\System\Application::end();
