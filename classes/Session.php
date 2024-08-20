<?php
class Session{

    public static function put($name,$value){  // create session and append it to $_SESSION
        return $_SESSION[$name]=$value;

    }

    public static function exists($name){
        return isset($_SESSION[$name])?true:false;

    }
    
    public static function get($name){
        return $_SESSION[$name];

    }


    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }

    }
    public static function falsh($sessionName,$message=Null){  // you set it value Null , and U can overwrite it later 

        if(self::exists($sessionName)){
            $session=self::get($sessionName);
            self::delete($sessionName);
            return $session; 
        }
        else{
             self::put($sessionName,$message);
        }
        return 'no falsh to show';


    }
}


?>