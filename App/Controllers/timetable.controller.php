<?php
/**
 * Created by PhpStorm.
 * User: pveb_student
 * Date: 14/12/16
 * Time: 14:01
 */

class TimetableController extends Controller {

    public function index() {
        $shows = TimeTable::getAll();

        View::render("timetable.view.php",["shows"=>$shows]);
    }
}