<?php
/**
 * Created by PhpStorm.
 * User: pveb_student
 * Date: 14/12/16
 * Time: 11:45
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once(ROOT.DS.'lib'.DS.'init.php');

$router = new Router($_SERVER['REQUEST_URI']);
/*
echo "<pre>";
print_r('Route: '.$router->getRoute().PHP_EOL);
print_r('Controller: '.$router->getController().PHP_EOL);
print_r('Action: '.$router->getMethodPrefix().$router->getAction().PHP_EOL);
echo "Params: ";
print_r($router->getParams());
*/

App::run($_SERVER['REQUEST_URI']);

if($_SESSION['login_user'] != null) {
    echo $_SESSION['login_user'];
    echo $_SESSION['user_id'];
}