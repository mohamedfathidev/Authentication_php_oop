<?php 


require_once 'core/init.php';

$user = DB::getInstance()->get('users',['username','=','mofa']);


if(session::exists('suc')){
    echo Session::falsh('suc');

}


echo "<br>";

echo "<h1>Hello To The Main Page<h2>";