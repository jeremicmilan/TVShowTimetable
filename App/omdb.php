<?php

namespace App;

class OMDb
{
    public static function searchShowByTitle($title)
    {
        $host = "http://www.omdbapi.com/?";
        $titleParam = "s=".str_replace(" ", "+", $title);
        $type = "type=series";
        $format = "r=json";

        $url = $host.$titleParam."&".$type."&".$format;

        $json = self::get_web_page($url);

        $tvshows = json_decode($json);

        return $tvshows;
    }

    public static function getShowByTitle($title)
    {
        $host = "http://www.omdbapi.com/?";
        $titleParam = "t=".str_replace(" ", "+", $title);
        $type = "type=series";
        $plot = "plot=full";
        $format = "r=json";

        $url = $host.$titleParam."&".$type."&".$plot."&".$format;

        $json = self::get_web_page($url);

        $tvshow = json_decode($json);

        return $tvshow;
    }

    public static function getShowById($id)
    {
        $host = "http://www.omdbapi.com/?";
        $idParam = "i=".$id;
        $plot = "plot=full";
        $format = "r=json";
        $type = "type=series";

        $url = $host.$idParam."&".$type."&".$plot."&".$format;

        $json = self::get_web_page($url);

        $tvshow = json_decode($json);

        return $tvshow;
    }

    public static function getSeasonsForShowById($id)
    {
        $host = "http://www.omdbapi.com/?";
        $idParam = "i=".$id;
        $plot = "plot=full";
        $format = "r=json";


        $tvshow = self::getShowById($id);

        $seasons = [];

        for ($i = 1; $i <= $tvshow->totalSeasons; $i++) {
            $seasonParam = "Season=".$i;

            $url = $host.$idParam."&".$plot."&".$format."&".$seasonParam;

            $json = self::get_web_page($url);

            $season = json_decode($json);

            $seasons[$i] = $season;
        }

        return $seasons;
    }

    public static function getEpisodesForSeason($tvshow_id, $season)
    {
        $host = "http://www.omdbapi.com/?";
        $idParam = "i=".$tvshow_id;
        $plot = "plot=full";
        $format = "r=json";

        $episodes = [];

        foreach ($season->Episodes as $episode) {
            $seasonParam = "Season=".$season->Season;
            $episodeParam = "Episode=".$episode->Episode;

            $url = $host.$idParam."&".$plot."&".$format."&".$seasonParam."&".$episodeParam;

            $json = self::get_web_page($url);

            $result = json_decode($json);

            $episodes[$episode->Episode] = $result;
        }

        return $episodes;
    }

    public static function imdbIdToNum($id)
    {
        preg_match("/([0-9]+)/", $id, $matches);
        return intval($matches[0]);
    }

    public static function numToImdbId($id)
    {
        if ($id[0] == "t")
            return $id;
        else
            return "tt".sprintf("%07s", $id);
    }

    private static function get_web_page($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER  => true,   // return web page
            CURLOPT_HEADER          => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION  => true,   // follow redirects
            CURLOPT_MAXREDIRS       => 10,     // stop after 10 redirects
            CURLOPT_ENCODING        => "",     // handle compressed
            CURLOPT_USERAGENT       => "test", // name of client
            CURLOPT_AUTOREFERER     => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT  => 120,    // time-out on connect
            CURLOPT_TIMEOUT         => 120,    // time-out on response
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}