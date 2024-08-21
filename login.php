<?php

require_once 'core/init.php';

$user = new User();



if(Input::exists()){
    $user->login(Input::get('username'),Input::get('password'));

    // $salt = $user->dataRow()->salt;

    // echo "<br>";
    // echo "<br>";
    // echo "Stored Password Hash: " . $user->dataRow()->password . "<br>";
    // echo "Stored Salt: " . bin2hex($salt) . "<br>";

    // echo "<hr>";

    // $hashedPassword = Hash::make(Input::get('password'), $salt);
    // echo "Hashed Input Password: " . $hashedPassword . "<br>";




    

}


?>

<form action="" method="post">
    <h2>Login Page</h2>
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <br><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br><br>
    <input type="submit" value="Login">
</form>




