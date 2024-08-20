<?php

require_once 'core/init.php';

$user= new User();

if(Input::exists()){
    $user->login(Input::get('username'),Input::get('password'));

}

?>


<form action="" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <br><br>
    <label for="password">password</label>
    <input type="password" name="password" id="password">
    <br><br>
    <input type="submit" value="Login">

</form>
