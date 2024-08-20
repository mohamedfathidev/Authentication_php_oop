<?php

class Config{

    public static function get($path=null){
        if($path){

        
        $config=$GLOBALS['config'];
        $path= explode('/',$path);
        foreach($path as $tem){
            if(isset($config[$tem])){
                $config=$config[$tem];
            }
            
        }
        return $config;
        }
        return false;
    }

} 


