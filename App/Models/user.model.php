<?php

namespace App\Model;

use Core\Model;

class UserModel extends Model
{
    public $username;
    public $user_id;

    public $error_login;
    public $error_register;

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
                $this->error_login = "Wrong username or password";

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
                $this->error_login = "Multpile users with same credentials";

                return false;
            }
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function registerUser($username, $password, $email)
    {
        try
        {
            $pdo=parent::getDB();

            $stmt = $pdo->prepare("SELECT `username` FROM `User` WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if($stmt->rowCount() != 0)
            {
                $this->error_register = "Already a user with this email address";

                return false;
            }


            $stmt = $pdo->prepare("INSERT INTO `User` (`username`, `password`, `email`)
                      VALUES (:username, :password, :email)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', md5($password));
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $this->InitUser($username,$password);

            return true;


        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

