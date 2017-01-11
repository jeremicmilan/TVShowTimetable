<?php

namespace Core;

class App {

    protected static $router;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri) {
        self::$router = new Router($uri);

        $controller_class = 'App\\Controllers\\'.ucfirst(self::$router->getController()).'Controller';
        $controller_action = strtolower(self::$router->getAction());

        // Calling controller's method
        $controller_object = new $controller_class();
        if(method_exists($controller_object, $controller_action)) {
            $result = $controller_object->$controller_action();

            echo $result;
        } else {
            throw new Exception('Method '.$controller_action.' of class '.$controller_class.' does not exist!');
        }
    }

}