<?php
/**
 * Created by PhpStorm.
 * User: pveb_student
 * Date: 14/12/16
 * Time: 14:01
 */

// for logging in
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'TVShowsTimetable');

class Serie {
    public $name;
    public $description;

    public function __construct($name, $description){
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return mixed
     */public  function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */public  function getDescription(){
        return $this->description;
    }
}

class PagesController extends Controller {

    public function index() {

?>

        <html>
            <head></head>
            <body>
            <div align = "right">
                <button type="button" onclick="document.location.href='logout';" >Log out</button>
            </div>


        <?php

            $sql = "SELECT * FROM TVShows tvs JOIN Watching w ON tvs.TVShow_id = w.TVShow_id WHERE user_id = $_SESSION[user_id])";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        ?>
            <table>
                <?php foreach($series as $i => $serie) {
                    ?><tr>
                    <th><?php echo $serie->getTitle(); ?> </th>
                    <th><?php echo $serie->getDescription(); ?> </th>
                    </tr>
                <?php } ?>
            </table>

        </body>
        </html>
<?php
    }

    public function login() {
        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

        session_start();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form


            $myusername = mysqli_real_escape_string($db,$_POST['username']);
            $mypassword = mysqli_real_escape_string($db,$_POST['password']);

            $sql = "SELECT user_id FROM `User` WHERE username = '".$myusername."' and password = md5('".$mypassword."')";
            $result = mysqli_query($db,$sql);

            $count = mysqli_num_rows($result);

            // If result matched $myusername and $mypassword, table row must be 1 row

            if($count == 1) {
                $_SESSION['login_user'] = $myusername;
                $_SESSION['user_id'] = $result->fetch_row()[0];

                header("location: index");
            }else {
                $error = "Your Login Name or Password is invalid";
            }
        }
        ?>
        <html>
            <head>
                <title>Login Page</title>

                <style type = "text/css">
                    body {
                        font-family:Arial, Helvetica, sans-serif;
                        font-size:14px;
                    }

                    label {
                        font-weight:bold;
                        width:100px;
                        font-size:14px;
                    }

                    .box {
                        border:#666666 solid 1px;
                    }
                </style>

            </head>

            <body bgcolor = "#FFFFFF">

                <div align = "center">
                    <div style = "width:300px; border: solid 1px #333333; " align = "left">
                        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

                        <div style = "margin:30px">

                            <form action = "" method = "post">
                                <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                                <input type = "submit" value = " Submit "/><br />
                            </form>

                            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

                        </div>

                    </div>

                </div>

            </body>
        </html>
    <?php
    }

    public function logout() {
        session_start();

        if(session_destroy()) {
            header("Location: login");
        }
    }

    public function view() {
        $params = App::getRouter()->getParams();

        if(isset($params[0])) {
            $alias = strtolower($params[0]);

            echo "Here will be a page with '{$alias}' alias";
        }
    }

    // add serie
    public function add($name)
    {

    }
}