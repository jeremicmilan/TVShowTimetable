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

            if(!is_numeric($id))
                $id=0;

            $pdo=parent::getDB();

            $session->commit();
            $query = "SELECT *
                      FROM `TVShow` tvs
                      JOIN `Watching` w ON tvs.`tvshow_id` = w.`tvshow_id`
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

    public function getShowFromDB($title)
    {
        try
        {
            $pdo = parent::getDB();

            $query = "SELECT *
                      FROM `TVShow` tvs
                      WHERE lower(title) = '" . strtolower($title) . "'";

            $stmt = $pdo->query($query);

            if ($stmt == false)
            {
                return false;
            }
            else
            {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return count($result) == 0 ? false : $result[0];
            }
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function addShowToDB($tvshow)
    {
        try
        {
            $pdo=parent::getDB();

            $id = OMDb::imdbIdToNum($tvshow->imdbID);
            $title = $tvshow->Title;
            $plot = addcslashes($tvshow->Plot, "\'");
            $poster= $tvshow->Poster;

            $stmt = $pdo->prepare("INSERT INTO `TVShow` (`tvshow_id`, `title`, `description`, `last_update`, `picture`)
                                   VALUES (:id, :title, :plot, CURRENT_DATE, :poster)");
            $stmt->bindParam(':id', $id);
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

    public function addSeasonsToDb($id, $seasons)
    {
        foreach ($seasons as $season)
        {
            try
            {
                $pdo=parent::getDB();

                $tvshow_id = OMDb::imdbIdToNum($id);
                $season_id = $season->Season;

                $stmt = $pdo->prepare("INSERT INTO `Season` (`tvshow_id`, `season_id`)
                                       VALUES (:tvshow_id, :season_id)");
                $stmt->bindParam(':tvshow_id', $tvshow_id);
                $stmt->bindParam(':season_id', $season_id);
                $stmt->execute();

                $episodes = OMDb::getEpisodesForSeason($id, $season);

                foreach ($episodes as $episode)
                {
                    $stmt = $pdo->prepare("INSERT INTO `Episode` (`tvshow_id`, `season_id`, `episode_id`, `title`, `airdate`, `description`, `picture`)
                                           VALUES (:tvshow_id, :season_id, :episode_id, :title, :airdate, :description, :picture)");
                    $stmt->bindParam(':tvshow_id', $tvshow_id);
                    $stmt->bindParam(':season_id', $season_id);
                    $stmt->bindParam(':episode_id', $episode->Episode);
                    $stmt->bindParam(':title', $episode->Title);
                    $stmt->bindParam(':airdate', $episode->Released);
                    $stmt->bindParam(':description', $episode->Plot);
                    $stmt->bindParam(':picture', $episode->Poster);
                    $stmt->execute();
                }
            }
            catch(\PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
}


