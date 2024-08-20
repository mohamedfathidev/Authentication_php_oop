<?php

class Redirect{
    public static function to($location){
        // echo __DIR__;
        if(is_numeric($location)){
            switch($location){
                case 404:
                    header('HTTP/1.1 404 Not Found');
                    include 'includes/errors/404.php';
                    exit();

                break;
            }
        }
        header("Location:".$location.".php");

    }
}

?>