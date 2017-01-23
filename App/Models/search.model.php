<?php

namespace App\Model;

use App\OMDb;
use Core\Model;

class SearchModel extends Model
{
    public $keyword;
    public $search_results;
    public $error;

    public function searchDatabase($title)
    {
        try {
            $pdo = parent::getDB();

            $query = "SELECT * 
                      FROM `TVShow`
                      WHERE LOWER(title) like '%$title%'";

            $stmt = $pdo->query($query);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}