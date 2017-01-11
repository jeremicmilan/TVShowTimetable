<?php

class TimeTable extends Model
{
    public static function getAll(){


        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        try{
            $pdo=parent::getDB();
            $query = "SELECT * FROM TVShows tvs JOIN Watching w ON tvs.TVShow_id = w.TVShow_id WHERE user_id = $_SESSION[user_id])";

            $stmt = $pdo->query($query);

            return $stmt->fetchAll(\PDO::FETCH_OBJ);

        }catch(\PDOException $e){
            echo $e->getMessage();
        }

    }

}


