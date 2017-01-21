<?php

namespace App\Controllers;

use App\Model;
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

    public function getShowFromOmdbByTitle($title)
    {
        // tt1124373
        // http://www.omdbapi.com/?i=tt1124373&plot=full&r=json

        $host = "http://www.omdbapi.com/?";
        $idParam = "t=".$title;
        $plot = "plot=full";
        $format = "r=json";

        $url = $host.$idParam."&".$plot."&".$format;

        $json = $this->get_web_page($url);

        $this->model->addShowToDB($json);

        $id = $this->model->getTVShowId($title);

        Core\App::redirect("tvshow", "index", [$id]);
    }

    private function get_web_page($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content  = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}