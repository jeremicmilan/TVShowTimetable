<?php

namespace App\Controllers;

use App\Model;
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
        // TODO: if not in DB, check OMDb
        $this->model->initTVShow($id);
        $this->view->render("tvshow.view.php");
    }

    public function follow($id)
    {
        $this->model->follow($id);
        Core\App::redirect("tvshow", "index", [$id]);
    }

    public function unfollow($id)
    {
        $this->model->unfollow($id);
        Core\App::redirect("timetable");
    }
}