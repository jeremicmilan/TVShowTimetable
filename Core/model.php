<?php

namespace Core;

use App\Config;

abstract class Model
{
    public static function getDB(){
        static $db = null;

        if($db == null) {
            try{
                $db = new \PDO(
                    "mysql:host=".Config::DB_HOST.";".
                    "dbname=".Config::DB_dbname,
                    Config::DB_username,
                    Config::DB_password);
            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }
        return $db;
    }

}