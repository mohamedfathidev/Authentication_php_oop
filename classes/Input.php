<?php 
class Input{
    public static function exists($type='post'){
        switch($type){
            case 'post':
            case 'POST':
                return (!empty($_POST))?true:false;
            break;

            case 'get':
            case 'GET':
                return (!empty($_GET))?true:false;
            break;

            default:
                return false;


        }
    }

    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        }
        else if(isset($_GET[$item])){
            return $_GET[$item];

        }
        else { 
            return '';
            
        }

    }
    
}



?>