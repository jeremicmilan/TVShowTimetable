<?php

namespace App\Model;

use Core\Model;

class TvshowModel extends Model
{
    public $tvshow_info;
    public $episodes_info;
    public $ourId;
    public $isFollowed;

    public function initTVShow($id)
    {
        try
        {
            $session_factory = new \Aura\Session\SessionFactory;
            $session = $session_factory->newInstance($_COOKIE);

            $segment = $session->getSegment("userData");
            $user_id = $segment->get("user_id");

            $pdo = parent::getDB();

            $query = "SELECT * 
                    FROM `TVShow`
                    WHERE TVShow_id = $id";

            $stmt = $pdo->query($query);
            $this->tvshow_info = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

            $query = "SELECT e.airdate, e.description
                    FROM `TVShow` tvs JOIN `Season` s ON tvs.TVShow_id=s.TVShow_id
                    JOIN `Episode` e ON s.season_id = e.season_id
                    WHERE tvs.TVShow_id = $id ORDER BY e.airdate";

            $stmt = $pdo->query($query);
            $this->episodes_info = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $query = "SELECT `TVShow_id`
                    FROM  `Watching` w
                    WHERE `TVShow_id` = $id AND user_id = $user_id";

            $stmt = $pdo->query($query);
            $this->isFollowed = $stmt == false ? false : $stmt->rowCount() > 0;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function follow($id)
    {
        $session_factory = new \Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);

        $segment = $session->getSegment("userData");
        $user_id = $segment->get("user_id");

        try
        {
            $pdo = parent::getDB();

            $query = "INSERT INTO `Watching`
                      VALUES ($user_id, $id)";

            $pdo->query($query);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function unfollow($id)
    {
        $session_factory = new \Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);

        $segment = $session->getSegment("userData");
        $user_id = $segment->get("user_id");

        try
        {
            $pdo = parent::getDB();

            $query = "DELETE FROM `Watching`
                      WHERE user_id = $user_id AND TVShow_id = $id";

            $pdo->query($query);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}