<?php

namespace App\Model;

use Core\Model;

class UserModel extends Model
{
    public $username;
    public $id;

    public function initData(){
        try{
            $pdo=parent::getDB();
            $query = "SELECT * FROM `TVShow` tvs JOIN `Watching` w ON tvs.`TVShow_id` = w.`TVShow_id` WHERE `user_id` = 1";


            $stmt = $pdo->query($query);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
}

