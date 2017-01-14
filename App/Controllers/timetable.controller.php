<?php

namespace App\Controllers;

use App\Model;
use Core;

class TimetableController extends Core\Controller {

    public function __construct()
    {
        $this->model = new Model\TimetableModel;
        $this->view = new Core\View($this, $this->model);
    }

    public function index() {
        $this->model->initAllShows();
        $this->view->render("timetable.view.php");
    }
}