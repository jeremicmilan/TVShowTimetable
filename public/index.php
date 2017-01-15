<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('HOST', $_SERVER['HTTP_HOST']);

require(ROOT.DS.'vendor'.DS.'autoload.php');

$uri = urldecode(trim($_SERVER['REQUEST_URI'],'/'));

$uri_parts = explode('?', $uri);

$path = $uri_parts[0];
//$uri_params = $uri_parts[1];

$path_parts = explode('/', $path);
$pos = array_search("TVShowsTimetable", $path_parts);

define('ROOT_URI', implode('/', array_slice($path_parts, 0, $pos + 1)));
$path_parts = array_slice($path_parts, $pos + 1);

if (count($path_parts) > 0 && $path_parts[0] == "public")
{
    echo file_get_contents(ROOT.$uri);
}
else
{
    $controller_uri = implode(DS, $path_parts);

    Core\App::run($controller_uri);
}
