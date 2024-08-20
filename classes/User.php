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
        
        if($userData->counter()){
            $this->_data=$userData->first();
            return true;        
        }
        return false;
    }

    
    public function login($username,$password){
        $user=$this->find($username);
        $salt=$this->_data->salt;
        if($user){
            if($this->_data->password === Hash::make($password,$salt)){
                echo "You are loged in successfully";
            }else{
                echo "Invalid Password";
            }

            Session::put($this->_sessionName,$this->_data->id);


        }

        


        // Sesssion::put($this->_sessionName,)

       

        

    }
}
