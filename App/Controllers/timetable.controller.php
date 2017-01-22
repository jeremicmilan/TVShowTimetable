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
        $this->model->initTimetable();
        $this->view->render("timetable.view.php");
    }

    public function shows()
    {
        $this->model->initAllShows();
        $this->view->render("tvshows.view.php");
    }

    public function about()
    {
        $this->view->render("about.view.php");
    }
}