<?php

session_start();


$GLOBALS['config']=[
    "mysql"=>[
        'host'=>'127.0.0.1',
        'username'=>'root',
        'password'=>'',
        'db'=>'auth_system'


    ],
    "session"=>[
        'session_name'=>'user',
        'token_name'=>'token_value'

    ]
    ,
    "remember"=>
    [
        'cookie_name'=>'hash',
        'cookie_expire'=>604800

    ]

    ];



spl_autoload_register(function($className){
    
    
    $file_dir=__DIR__ . '/../classes/' . $className . '.php';

    if (file_exists($file_dir)) {
        require_once $file_dir;
    } else {
        echo "Class file not found: " . $file_dir;
    }
});


require_once __DIR__.'/../functions/sanatize.php';




?>