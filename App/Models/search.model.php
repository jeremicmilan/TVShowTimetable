<?php

namespace App\Model;

use App\OMDb;
use Core\Model;

class SearchModel extends Model
{
    public $database_results;
    public $omdb_result;

    public function searchDatabase($title)
    {
        try {
            $pdo = parent::getDB();

            $query = "SELECT * 
                        FROM `TVShow`
                        WHERE LOWER(title) like '%$title%'";

            $stmt = $pdo->query($query);
            $this->database_results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function searchOmdbByTitle($title)
    {
        $title = str_replace(" ", "+", $title);
        $this->omdb_result = OMDb::getShowByTitle($title);
        var_dump( $this->omdb_result);
    }

    public function searchOmdbById($id)
    {
        $this->omdb_result = OMDb::getShowById($id);
        $this->addShowToDB($this->omdb_result);
    }
}