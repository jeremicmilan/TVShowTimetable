<?php

namespace App\Controllers;

use App\Model;
use Core;

class SearchController extends Core\Controller
{
    public function __construct()
    {
        $this->model = new Model\SearchModel;
        $this->view = new Core\View($this, $this->model);
    }

    public function searchDatabase($title)
    {
        $this->model->searchDatabase($title);
        $this->view->render("search.view.php");
    }

    public function searchOmdbByTitle($title)
    {
        $this->model->searchOmdbByTitle($title);
        $this->view->render("search.view.php");
    }

}