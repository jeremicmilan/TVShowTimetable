<?php

namespace App\Controllers;

use App\Model;
use App\OMDb;
use Core;

class TimetableController extends Core\Controller
{
    public function __construct()
    {
        $this->model = new Model\TimetableModel;
        $this->view = new Core\View($this, $this->model);
    }

    public function index()
    {
        $this->model->initAllShows();
        $this->view->render("timetable.view.php");
    }

    public function addShowByTitle($title)
    {
        $tvshow = OMDb::getShowByTitle($title);

        $this->model->addShowToDB($tvshow);

        $id = $this->model->getTVShowId($title);

        Core\App::redirect("tvshow", "index", [$id]);
    }

    public function addShowById($id)
    {
        $tvshow = OMDb::getShowFromOmdbById($id);

        $this->model->addShowToDB($tvshow);

        Core\App::redirect("tvshow", "index", [$id]);
    }
}