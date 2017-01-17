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
        $params = "";

        $first = true;
        foreach (self::$router->getParams() as $param)
        {
            if (!$first)
            {
                $params = $params.", ";
            }

            $params = $params.$param;

            $first = false;
        }

        // Calling controller's method
        $controller_object = new $controller_class();
        if(method_exists($controller_object, $controller_action)) {
            $result = $controller_object->$controller_action($params);

            echo $result;
        } else {
            throw new \Exception('Method '.$controller_action.' of class '.$controller_class.' does not exist!');
        }
    }

    public static function redirect($controller, $action = "index", $params=[])
    {
        $uri = HOST.DS.ROOT_URI.DS.$controller.DS.$action;

        foreach ($params as $param)
        {
            $uri = $uri.DS.$param;
        }

        header("Location: http://".$uri, false);
    }

}