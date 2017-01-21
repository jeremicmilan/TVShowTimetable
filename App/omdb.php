<?php

namespace App;

class OMDb
{
    public static function getShowByTitle($title)
    {
        // tt1124373
        // http://www.omdbapi.com/?i=tt1124373&plot=full&r=json

        $host = "http://www.omdbapi.com/?";
        $idParam = "t=".$title;
        $plot = "plot=full";
        $format = "r=json";

        $url = $host.$idParam."&".$plot."&".$format;

        $json = self::get_web_page($url);

        $tvshow = json_decode($json);

        return $tvshow;
    }

    public static function getShowFromOmdbById($id)
    {
        // tt1124373
        // http://www.omdbapi.com/?i=tt1124373&plot=full&r=json

        $host = "http://www.omdbapi.com/?";
        $idParam = "i=".$id;
        $plot = "plot=full";
        $format = "r=json";

        $url = $host.$idParam."&".$plot."&".$format;

        $json = self::get_web_page($url);

        $tvshow = json_decode($json);

        return $tvshow;
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