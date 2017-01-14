<?php

namespace App\Controllers;

use App\Model;
use App\Config;
use Core;

class UserController extends Core\Controller
{
    public function __construct()
    {
        $this->model = new Model\UserModel;
        $this->view = new Core\View($this, $this->model);
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($this->model->initUser($username, $password))
            {
                $session_factory = new \Aura\Session\SessionFactory;
                $session = $session_factory->newInstance($_COOKIE);

                $segment = $session->getSegment("userData");
                $segment->set("username", $this->model->username);
                $segment->set("user_id", $this->model->user_id);

                $session->commit();

                Core\App::redirect("timetable");
            }
            else
            {
                $this->view->render("login.view.php");
            }
        }
        else
        {
            $this->view->render("login.view.php");
        }

    }

    public function logout() {
        if(session_destroy()) {
            header("Location: login");
        }
    }
}