<?php 

require_once 'core/init.php';

class Validation { 
    private $_db,$_errors=[],$_passed=false;

    public function __construct()
    {
         $this->_db = DB::getInstance();
        
    }

    public function check($source,$items=[]){
        foreach($items as $item => $rules){
            
            
            foreach($rules as $rule=>$rule_value){
                $value=isset($source[$item])?$source[$item]:'';
                if($rule==='required'&& empty($value)){
                    $this->addError("the {$item} is required");
                }else if(!empty($value)){
                    if($rule==='string' && !is_string($value)){
                        $this->addError("the {$item} should be a string");
                    }
                    if($rule==='min' && strlen($value)<$rule_value){
                        $this->addError("the {$item} is less than $rule_value characters");
                    }
                    if($rule==='max' && strlen($value)>$rule_value){
                        $this->addError("the {$item} is more than $rule_value characters");
                    }
                    if($rule==='unique' && $this->_db->get($rule_value,[$item,"=",$value])){
                        $this->addError("the {$item} is exists already!");
    
                    }
                    
                    if($rule==='matches' && $value!=$source[$rule_value]){
                        $this->addError("the password not matches");
                    }
                }
                
                    


            } 
        }
        if(empty($this->errors())){
            return $this->_passed=true;
        }

        
        return $this;
    }

    private function addError($error){
        $this->_errors[]=$error;
    }

    public function errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }
}