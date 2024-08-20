<?php 

class Hash{

    public static function make($pass,$salt=''){
        return hash('sha256', $pass.$salt);

    }
    public static function salt($length){
        return random_bytes($length);

    }
    public static function unique(){
       return self::make(uniqid());

    }
}


?>