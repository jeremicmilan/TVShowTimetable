<?php

namespace App\Controllers;

use App\Model\Post;
use Core\View;

class UserController extends Controller {

public function index() {
    $this->login();
}

public function login() {
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form

        $model = new UserModel();
        $model->initData();

        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);

        $sql = "SELECT user_id FROM `User` WHERE username = '".$username."' and password = md5('".$password."')";
        $result = mysqli_query($db,$sql);

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if($count == 1) {
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id'] = $result->fetch_row()[0];

            if($_SESSION['login_user'] != null) {
                echo $_SESSION['login_user'];
                echo $_SESSION['user_id'];
            }

            header("location: index");
        } else {
            $error = "Your Login Name or Password is invalid";
        }
    }
    else
    {
        View::render("login.view.php");
    }

}

public function logout() {
    session_start();

    if(session_destroy()) {
        header("Location: login");
    }
}
}