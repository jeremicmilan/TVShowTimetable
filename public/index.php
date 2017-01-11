<?php

if (!isset($_SERVER['REQUEST_URI']))
{
    $_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'],1 );
    if (isset($_SERVER['QUERY_STRING'])) { $_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING']; }
}

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$loader = require(ROOT.DS.'vendor'.DS.'autoload.php');

$router = new \Core\Router($_SERVER['REQUEST_URI']);

$session_factory = new \Aura\Session\SessionFactory;
$session = $session_factory->newInstance($_COOKIE);

Core\App::run($_SERVER['REQUEST_URI']);