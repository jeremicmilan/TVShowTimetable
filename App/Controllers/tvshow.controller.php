<?php

namespace App\Controllers;

use App\Model;
use App\OMDb;
use Core;

class TvshowController extends Core\Controller
{
    public function __construct()
    {
        $this->model = new Model\TvshowModel;
        $this->view = new Core\View($this, $this->model);
    }

    public function index($id)
    {
        if (!$this->model->initTVShowFromDb(OMDb::imdbIdToNum($id)))
        {
            $this->model->initTVShowFromOMDb($id);
        }

        $this->view->render("tvshow.view.php");
    }

    public function follow($id)
    {
        $session_factory = new \Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);

        $segment = $session->getSegment("userData");
        if  ($segment->get("user_id") == false)
        {
            Core\App::redirect("user", "login");
            return;
        }

        $tvshow = $this->model->getShowFromDbById(OMDb::imdbIdToNum($id));

        if ($tvshow == false)
        {
            $tvshow = OMDb::getShowById($id);

            $this->model->addShowToDB($tvshow);

            $this->addEpisodesForShow($id);
        }

        $this->model->follow(OMDb::imdbIdToNum($id));
        Core\App::redirect("tvshow", "index", [$id]);
    }

    public function unfollow($id)
    {
        $this->model->unfollow($id);
        Core\App::redirect("timetable");
    }

    public function addShowByTitle($title)
    {
        if (($tvshow = $this->model->getShowFromDbByTitle($title)))
        {
            $id = OMDb::numToImdbId($tvshow['tvshow_id']);
        }
        else
        {
            $tvshow = OMDb::getShowByTitle($title);

            $this->model->addShowToDB($tvshow);

            $id = $tvshow->imdbID;

            $this->addEpisodesForShow($id);
        }

        Core\App::redirect("tvshow", "index", [$id]);
    }

    public function addShowById($id)
    {
        if (($tvshow = $this->model->getShowFromDbById(OMDb::imdbIdToNum($id))))
        { }
        else
        {
            $tvshow = OMDb::getShowById($id);

            $this->model->addShowToDB($tvshow);

            $this->addEpisodesForShow($id);
        }

        Core\App::redirect("tvshow", "index", [$id]);
    }

    private function addEpisodesForShow($id)
    {
        $seasons = OMDb::getSeasonsForShowById($id);

        $this->model->addSeasonsToDb($id, $seasons);
    }
}