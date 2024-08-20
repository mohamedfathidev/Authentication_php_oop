<?php
require_once 'core/init.php';  // i made require here for session_start() not autoloader function 


if(Input::exists()){
    if(Token::check(Input::get('csrf_token'))){


$validator = new Validation();
$validationData = $validator->check($_POST,array(
    'username'=>array(
        'required'=>true,
        'min'=>3,
        'max'=>70,
        'string'=>true
        
    )
    ,
    'password'=>array(
        'required'=>true,
        'min'=>4,
        'max'=>60,
    )
    ,
    'password-again'=>array(
        'required'=>true,
        'min'=>4,
        'matches'=>'password'
        
    )
    ,
    'name'=>array(
        'required'=>true,
        'min'=>5,
        'max'=>100,
        
    )
    ));
    {

    }

    if($validator->passed()){
        // All its mission : to set the message will appear and be in session and print it wherever you want
        // and for that i made the $message = null ;  

        // redirect the index.php 
        

        
        try{

        $user=new User();

        $salt=Hash::salt(10);
            
        $user->create([
            'username'=>Input::get('username'),
            'password'=>Hash::make(Input::get('password'),$salt),
            'name'=>input::get('name'),
            'salt'=>$salt,
            'join_at'=>date('Y-m-d H:i:s'),
            'grp'=>1

        ]);
        Session::falsh('suc','Account Created Successfully');
        
        Redirect::to('index');
           
        }
        catch(Exception $e){
            echo ($e->getMessage());
        }



        
    }
    else{
        $invalidErrors=$validator->errors(); // return array of failed rules 
        foreach($invalidErrors as $err){
            echo $err."<br>";
        }
        
    }

}
}
    

?>
<!-- <h1 style="background:gray;display:inline;margin-bottom:20px">Register Form</h2><br><br> -->
<form action="" method="post">
    <div class="field1" style="margin-bottom: 5px;">
        
        <input type="hidden" name="csrf_token" id="token" value="<?php  echo Token::generate();  ?>">
    </div>
    <div class="field1" style="margin-bottom: 5px;">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
    </div>
    <div class="field2" style="margin-bottom: 5px;">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" autocomplete="off">
    </div>
    <div class="field3" style="margin-bottom: 5px;">
        <label for="password-again">Password Again</label>
        <input type="text" name="password-again" id="password-again" autocomplete="off">
    </div>
    <div class="field4" style="margin-bottom: 5px;">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo  escape(Input::get('name'));  ?>" autocomplete="off">
    </div>
    <button type="submit">Register</button>
    <button type="reset">Reset</button>
</form>