<?php

namespace App\Model;

use App\OMDb;
use Core\Model;

class TimetableModel extends Model
{
    public $shows;
    public $days = [];

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

    public function initTimetable()
    {
        try
        {
            $session_factory = new \Aura\Session\SessionFactory;
            $session = $session_factory->newInstance($_COOKIE);

            $segment = $session->getSegment("userData");
            $user_id = $segment->get("user_id");

            $pdo=parent::getDB();

            $dateFormat = "Y-m-d";
            $dateInterval = 7;

            $dateStart = date($dateFormat);
            $dateEnd = date($dateFormat, strtotime($dateStart. " + $dateInterval days"));

            for ($date = $dateStart; $date < $dateEnd; $date = date($dateFormat, strtotime($date. " + 1 days"))) {
                $query = "SELECT DISTINCT tvs.`tvshow_id`, tvs.`title` AS tvshow_name, s.`season_id`, e.*
                          FROM `TVShow` tvs
                          JOIN `Season` s ON tvs.`tvshow_id` = s.`tvshow_id`
                          JOIN `Episode` e ON tvs.`tvshow_id` = e.`tvshow_id` AND s.`season_id` = e.`season_id`
                          WHERE DATE_FORMAT(e.`airdate`, '%Y-%m-%d') = '$date'
                          ORDER BY tvs.`title` ASC, s.`season_id` ASC, e.`episode_id` ASC";

                $stmt = $pdo->query($query);

                $episodes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($episodes as $key => $episode)
                {
                    if ($user_id != false)
                    {
                        $show_id = $episode["tvshow_id"];

                        $query = "SELECT *
                                  FROM `Watching`
                                  WHERE `user_id` = $user_id AND `tvshow_id` = $show_id";
                        $stmt = $pdo->query($query);

                        $is_followed = !empty($stmt->fetchAll(\PDO::FETCH_ASSOC));
                    }
                    else
                    {
                        $is_followed = false;
                    }

                    $episodes[$key]["is_followed"] = $is_followed;
                }

                $this->days[$date] = $episodes;
            }
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}


