<?php

namespace App\Model;

use App\OMDb;
use Core\Model;

class TvshowModel extends Model
{
    public $tvshow_info;
    public $season_count;
    public $seasons;
    public $isFollowed;

    public function initTVShowFromDb($id)
    {
        try
        {
            $session_factory = new \Aura\Session\SessionFactory;
            $session = $session_factory->newInstance($_COOKIE);

            $segment = $session->getSegment("userData");
            $user_id = $segment->get("user_id");

            $pdo = parent::getDB();

            $id = OMDb::imdbIdToNum($id);

            $query = "SELECT * 
                      FROM `TVShow`
                      WHERE tvshow_id = $id";

            $stmt = $pdo->query($query);

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(empty($result))
                return false;

            $this->tvshow_info = $result[0];

            $query = "SELECT COUNT(season_id) 'count'
                      FROM `Season`
                      WHERE tvshow_id = $id";

            $stmt = $pdo->query($query);
            $this->season_count = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]["count"];

            $query = "SELECT season_id
                      FROM `Season`
                      WHERE tvshow_id = $id
                      ORDER BY season_id ASC";

            $stmt = $pdo->query($query);
            $seasons = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($seasons as $season)
            {
                $season_id = $season["season_id"];
                $query = "SELECT *
                          FROM `Episode`
                          WHERE season_id = $season_id AND tvshow_id = $id
                          ORDER BY episode_id ASC";

                $stmt = $pdo->query($query);
                $episodes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $seasons[$season_id - 1]["episodes"] = $episodes;
            }

            $this->seasons = $seasons;

            $query = "SELECT `TVShow_id`
                      FROM  `Watching` w
                      WHERE `tvshow_id` = $id AND user_id = $user_id";

            $stmt = $pdo->query($query);
            $this->isFollowed = $stmt == false ? false : $stmt->rowCount() > 0;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

        return true;
    }

    public function initTVShowFromOMDb($id)
    {
        $tvshow = OMDb::getShowById($id);

        $this->tvshow_info["tvshow_id"] = $tvshow->imdbID;
        $this->tvshow_info["title"] = $tvshow->Title;
        $this->tvshow_info["description"] = $tvshow->Plot;
        $this->tvshow_info["picture"] = $tvshow->Poster;

        $this->season_count = $tvshow->totalSeasons;
        $this->isFollowed = false;

        $seasons = OMDb::getSeasonsForShowById($id);

        $seasonsReturn = [];

        $seasonCount = 0;
        foreach ($seasons as $season)
        {
            $seasonsReturn[$seasonCount]["season_id"] = $season->Season;

            $episodeCount = 0;
            $episodeReturn = [];
            foreach ($season->Episodes as $episode)
            {
                $episodeReturn[$episodeCount]["title"] = $episode->Title;
                $episodeReturn[$episodeCount]["airdate"] = $episode->Released;
                $episodeCount++;
            }
            $seasonsReturn[$seasonCount]["episodes"] = $episodeReturn;
            $seasonCount++;
        }

        $this->seasons = $seasonsReturn;
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
                      VALUES ($user_id, '$id')";

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
                      WHERE user_id = $user_id AND TVShow_id = '$id'";

            $pdo->query($query);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function getShowFromDbByTitle($title)
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

    public function getShowFromDbById($id)
    {
        try
        {
            $pdo = parent::getDB();

            $query = "SELECT *
                      FROM `TVShow` tvs
                      WHERE tvshow_id = $id";

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
                                           VALUES (:tvshow_id, :season_id, :episode_id, :title, STR_TO_DATE(:airdate, '%d %b %Y'), :description, :picture)");
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