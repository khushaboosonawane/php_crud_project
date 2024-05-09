<?php
class Database{
    private $db_host="localhost";
    private $db_username="root";
    private $db_password="";
    private $db_database="school";
    private $conn=true;
    private $result=[];
    private $mysqli="";

    public function __construct(){
       if(!$this->conn){
        $this->mysqli=new mysqli($this->db_host,$this->db_username,$this->db_password,$this->db_database);
        if($this->mysqli->connect_error){
            array_push($this->result,$this->mysqli->connect_error);
            return false;
        }else{
            return true;
        }
       }
    }

    public function __destruct(){
        if($this->conn){
          if($this->mysqli->close()){
            $this->conn=false;
            return true;
          }
        }
        else{
            return false;
        }
    }
}
?>