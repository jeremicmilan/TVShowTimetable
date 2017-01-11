<?php

namespace Core;

class View
{
    protected $controller;
    protected $model;

    public function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }

    public static function render($view, $args=[]){

        if(isset($args)){
            extract($args, EXTR_SKIP);
        }

        if(is_readable("../App/Views/".$view))
            include "../App/Views/".$view;
        else
            echo "Error with $view file";

    }
}