<?php
require_once 'core/init.php';

class DB {

    private static $_instance = null;

    private $_pdo , $_query , $_results , $_errors=false , $_count=0;

    private function __construct()
    {
        $dsn='mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db');
        
        try{
            $this->_pdo= new PDO($dsn,Config::get('mysql/username'),Config::get('mysql/password'));
           

        }
        catch(PDOException $e){
            return $e->getMessage();
        }
        
    }

    public static function getInstance(){
        if(self::$_instance==null){
            self::$_instance= new DB();
        }
        return self::$_instance;

    }

    public function query($sql, $params = []) {
        $this->_errors = false;
    
        try {
            if ($this->_query = $this->_pdo->prepare($sql)) {
                if (count($params)) {
                    $x = 1;
                    foreach ($params as $para) {
                        $this->_query->bindValue($x, $para);
                        $x++;
                    }
                }
    
                if ($this->_query->execute()) {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else {
                    $this->_errors = true;  // Set errors to true if execution fails
                }
            } else {
                $this->_errors = true;   // Set errors to true if preparation fails
            }
        } catch (PDOException $e) {
            $this->_errors = true;
           
        }
    
        return $this;
    }

    public function action($action,$table,$where=[]){
        if(count($where)==3){
            
            $opertors=['<','>','=','>=','<='];

            $field=$where[0];
            $operator=$where[1];
            $value=$where[2];

            if(in_array($operator,$opertors)){
                $sql="{$action} FROM {$table} where {$field} {$operator} ?";

                if(!$this->query($sql,array($value))->error()){
                    return $this;   // FETCH_OBJ
                }
            }
        }
        return false;
    }

    public function get($table,$where){
        return $this->action('SELECT *',$table,$where);
    }
    public function delete($table,$where){
        return $this->action('DELETE',$table,$where);

    }
  
    public function insert($table,$fields=[]){
        if(count($fields)){

            $keys=array_keys($fields);
            $values='';
            $x=1;
            foreach($fields as $field){
                $values .= '? ';
                if($x < count($fields)){
                    $values .= ' ,';

                }
                $x++;
            }
            
        

            $sql="INSERT INTO {$table}(`".implode('`,`',$keys)."`)VALUES($values)";
            

            if(!$this->query($sql,$fields)->error()){
                return true;
            }
        }
        return false;
    }

    public function update($table,$id,$fields){
        if(count($fields)){
            
            $keys=array_keys($fields);
            $values=[];
            $set='`';$x=1;
            foreach($fields as $value){

                $values[]=$value;

            }
            foreach($keys as $key){
                $set.="`$key`=?";
                if($x<count($keys)){
                    $set.=',';

                }
                $x++;
            }
            $set.='`';
            
            
            


            $sql="UPDATE {$table} SET {$set} WHERE id=$id";
            echo $sql;

            if(!$this->query($sql,$values)->error()){
                return true;
            }
        }
        return false;

    }

    public function results(){
        return $this->_results;
    }
    
    public function first(){
        return $this->results()[0];
    }

    public function error(){
        return $this->_errors;
    }
    public function counter(){
        return $this->_count;
        
        
    }

    private function __clone()
    {  
        
    }

    

}