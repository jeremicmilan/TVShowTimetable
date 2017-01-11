<?php

namespace Core;

use App;

class Router {

    protected $uri;
    protected $controller;
    protected $action;
    protected $params;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function __construct($uri) {
        $this->uri = urldecode(trim($uri,'/'));

        $this->controller = App\Config::default_controller;

        $this->action = App\Config::default_action;

        $uri_parts = explode('?', $this->uri);

        // Get path like http://localhost/TVShowsTimetable/controller/action/param1/param2
        $path = $uri_parts[0];
        $path_parts = explode('/', $path);

        $pos = array_search("TVShowsTimetable", $path_parts);
        $path_parts = array_slice($path_parts, $pos);
        if($path_parts[1] == "public")
            return;

        $i = 1;
        $length = count($path_parts);

        if($length > 1) {

            // Get controller - first element of array
            if($i < $length) {
                $this->controller = strtolower($path_parts[$i]);
                $i++;
            }

            // Get action - next element of array
            if($i < $length) {
                $this->action = strtolower($path_parts[$i]);
                $i++;
            }

            // Get params - the rest of elements in array
            $this->params = array_slice($path_parts, $i);
        }
    }
}