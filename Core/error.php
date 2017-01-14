<?php

namespace Core;

use App\Config;

class Error
{

    public static function errorHandler($level, $message, $file, $line){
        if(error_reporting()!==0){
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler(\Exception $exception){

        $code=$exception->getCode();
        if($code!=404){
            $code=500;
        }

        http_response_code($code);

        if(Config::show_errors){
            echo "Fatal error:";
            echo "<p> Message: ".$exception->getMessage()."</p>";
            echo "<p> Line: ".$exception->getLine()."</p>";
            echo "<p> File: ".$exception->getFile()."</p>";
        }
        else{
            /*$log_file=dirname(__DIR__)."/logs/log.txt";
            echo $log_file;
            ini_set("error_log", $log_file);
            $log_file=ini_get("error_log");
            echo "Postavljeno na:".$log_file;
            //error_log("Log error: ". date("Y-m-d"). " ". $exception->getMessage()." ".$exception->getLine(). " ".$exception->getFile());
            error_log("Helloo...");*/
            if($code==404){
                //echo "File not found";
                View::render("404.html");
            }
            else{
                echo "Internal server error";
            }
        }
    }
}