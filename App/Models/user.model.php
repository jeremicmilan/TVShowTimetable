<?php

namespace App\Model;

use Core\Model;

class UserModel extends Model
{
    public $username;
    public $user_id;

    public $error;

    public function InitUser($username, $password)
    {
        try
        {
            $pdo = parent::getDB();
            $query = "SELECT * FROM `User` WHERE `username` = '$username' AND `password` = '".md5($password)."'";

            $stmt = $pdo->query($query);

            $count = $stmt->rowCount();

            // If result matched $myusername and $mypassword, table row must be 1 row
            if ($count == 0)
            {
                $this->error = "Wrong username or password";

                return false;
            }
            elseif($count == 1)
            {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

                $this->username = $result["username"];
                $this->user_id = $result["user_id"];

                return true;
            }
            else
            {
                //TODO: Change error and log this server side (user shouldn't see this)
                $this->error = "Multpile users with same credentials";

                return false;
            }
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

