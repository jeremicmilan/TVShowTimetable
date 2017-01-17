<?php

namespace App\Model;

use Core\Model;

class TimetableModel extends Model
{
    public $shows;

    public function initAllShows()
    {
        try
        {
            $session_factory = new \Aura\Session\SessionFactory;
            $session = $session_factory->newInstance($_COOKIE);

            $segment = $session->getSegment("userData");
            $id = $segment->get("user_id");

            $pdo=parent::getDB();

            $session->commit();
            $query = "SELECT *
                      FROM `TVShow` tvs JOIN `Watching` w ON tvs.`TVShow_id` = w.`TVShow_id`
                      WHERE `user_id` = ".$id;

            $stmt = $pdo->query($query);

            $this->shows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function addShowToDB($json)
    {
        try
        {
            $tvshow = json_decode($json, true);

            $pdo=parent::getDB();

            $title = $tvshow['Title'];
            $plot = addcslashes($tvshow['Plot'], "\'");
            $poster= $tvshow['Poster'];

            $query = "INSERT INTO `TVShow` (`title`, `description`, `last_update`, `picture`)
                      VALUES ('$title', '$plot', CURRENT_DATE, '$poster')";

            $stmt = $pdo->query($query);

        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}


