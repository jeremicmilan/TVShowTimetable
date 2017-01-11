<?php

namespace App\Controllers;

use App\Model;
use Core\View;
use Core;

class TimetableController extends Core\Controller {

    public function index() {
        $shows = Model\TimetableModel::getAll();

        View::render("timetable.view.php",["shows"=>$shows]);
    }
}