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
        if($keyword != '')
        {
            $results = OMDb::searchShowByTitle($keyword);
            if (property_exists($results, "Search"))
            {
                $this->model->search_results = OMDb::searchShowByTitle($keyword)->Search;
                $this->model->error = false;
            }
            else
            {
                $this->model->error = $results->Error;
            }
        }
        else
        {
            $this->model->search_results = [];
        }
        $this->view->render("partial/search_results.view.php");
    }

}