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
        if (($tvshow = $this->model->getShowFromDB($title)))
        {
            $id = OMDb::numToImdbId($tvshow['tvshow_id']);
        }
        else
        {
            $tvshow = OMDb::getShowByTitle($title);

            $this->model->addShowToDB($tvshow);

            $id = $tvshow->imdbID;

            $this->getEpisodesForShow($id);
        }

        Core\App::redirect("tvshow", "index", [$id]);
    }

    public function addShowById($id)
    {
        $tvshow = OMDb::getShowById($id);

        $this->model->addShowToDB($tvshow);

        $this->getEpisodesForShow($id);

        Core\App::redirect("tvshow", "index", [$id]);
    }

    private function getEpisodesForShow($id)
    {
        $seasons = OMDb::getSeasonsForShowById($id);

        $this->model->addSeasonsToDb($id, $seasons);
    }
}