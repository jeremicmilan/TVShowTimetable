<?php

namespace App\Controllers;

use App\Model;
use App\OMDb;
use Core;

class SearchController extends Core\Controller
{
    public function __construct()
    {
        $this->model = new Model\SearchModel;
        $this->view = new Core\View($this, $this->model);
    }

    public function index($keyword)
    {
        $this->model->keyword = $keyword;
        $this->view->render("search.view.php");
    }

    public function searchDatabase($title)
    {
        echo $this->model->searchDatabase($title);
    }

    public function searchOmdbByTitle($keyword)
    {
        echo json_encode(OMDb::searchShowByTitle($keyword)->Search);
    }

}