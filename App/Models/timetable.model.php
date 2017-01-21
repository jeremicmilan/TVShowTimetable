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

            if(!is_numeric($id))
                $id=0;

            $pdo=parent::getDB();

            $session->commit();
            $query = "SELECT *
                      FROM `TVShow` tvs JOIN `Watching` w ON tvs.`TVShow_id` = w.`TVShow_id`
                      WHERE `user_id` = $id
                      ORDER BY `title`";

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

            $stmt = $pdo->prepare("INSERT INTO `TVShow` (`title`, `description`, `last_update`, `picture`)
                      VALUES (:title, :plot, CURRENT_DATE, :poster)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':plot', $plot);
            $stmt->bindParam(':poster', $poster);
            $stmt->execute();
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function getTVShowId($name)
    {
        try
        {
            $pdo = parent::getDB();

            $query = "SELECT `TVShow_id`
                    FROM `TVShow` tvs
                    WHERE lower(title) = '".strtolower($name)."'";

            $stmt = $pdo->query($query);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['TVShow_id'];
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}


