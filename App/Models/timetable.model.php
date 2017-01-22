<?php

namespace App\Model;

use App\OMDb;
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
            if ($id != false) {
                $query = "SELECT *
                          FROM `TVShow` tvs
                          JOIN `Watching` w ON tvs.`tvshow_id` = w.`tvshow_id`
                          WHERE `user_id` = $id
                          ORDER BY `title`";
            }
            else
            {
                $query = "SELECT *
                          FROM `TVShow` tvs
                          ORDER BY `title`";
            }
            $stmt = $pdo->query($query);

            $this->shows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}


