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

    public function render($file){
        if(is_readable("../App/Views/".$file))
            include "../App/Views/".$file;
        else
            echo "Error with $file file";

    }
}