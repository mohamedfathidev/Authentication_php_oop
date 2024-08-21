<?php

class User {
    private $_db,$_data,$_sessionName;
    public function __construct() {
        $this->_db=DB::getInstance();
        $this->_sessionName=Config::get('session/session_name');
    }
    public function create($fields=[]){
        if(!$this->_db->insert('users',$fields)){
            throw new Exception("There is no data inserted");
        }
    }

    public function find($user=''){
        $userData=$this->_db->get('users',['username','=',$user]);
        
        if($userData->counter()>0){
            $this->_data=$userData->first();
            return true;        
        }
        return false;
    }

    
    
    public function login($username, $password) {
        $user = $this->find($username);
        
        if ($user) {
            $salt = $this->_data->salt;
            
            // Debugging: Print the exact salt and hashed password
            echo "Stored Salt (hex): " . $salt . "<br>";
            echo "Stored Password Hash: " . $this->_data->password . "<br>";
            
            $hashedInputPassword = Hash::make($password, $salt);
            echo "Hashed Input Password: " . $hashedInputPassword . "<br>";
            
            if ($this->_data->password === $hashedInputPassword) {
                echo "You are logged in successfully";
                Session::put($this->_sessionName, $this->_data->id);
            } else {
                echo "Invalid Password";
            }
        } 
    }
    
        

        


        

       

        

    

    public function dataRow(){
        return $this->_data;
    }
}
