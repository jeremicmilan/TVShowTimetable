<?php

namespace App;

class OMDb
{
    public static function getShowByTitle($title)
    {
        $host = "http://www.omdbapi.com/?";
        $idParam = "t=".$title;
        $plot = "plot=full";
        $format = "r=json";
        $type = "type=series";

        $url = $host.$idParam."&".$plot."&".$format."&".$type;

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

        $url = $host.$idParam."&".$plot."&".$format."&".$type;

        $json = self::get_web_page($url);

        $tvshow = json_decode($json);

        return $tvshow;
    }

    public static function getEpisodesForShowById($id)
    {
        $host = "http://www.omdbapi.com/?";
        $idParam = "i=".$id;
        $plot = "plot=full";
        $format = "r=json";
        $type = "type=episode";

        $url = $host.$idParam."&".$plot."&".$format."&".$type;

        $json = self::get_web_page($url);

        $episodes = json_decode($json);

        return $episodes;
    }

    private static function get_web_page($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content  = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}