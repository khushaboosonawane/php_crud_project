<?php
class Database{
    private $db_host="localhost";
    private $db_username="root";
    private $db_password="";
    private $db_database="school";
    private $conn=false;
    private $result=[];
    private $mysqli;

    public function __construct(){
       if(!$this->conn){
        $this->mysqli=new mysqli($this->db_host,$this->db_username,$this->db_password,$this->db_database);
        $this->conn=true;
        if($this->mysqli->connect_error){
            array_push($this->result,$this->mysqli->connect_error);
            return false;
        }else{
            return true;
        }
       }
    }
    public function insert($tableName,$param=array()){
        if($this->tableExist($tableName)){
            echo "<pre>";
            print_r($param);
            $tablekeys=implode(",",array_keys($param));
            $tablevalues=implode("' , '", $param);

            $sql="INSERT INTO $tableName ($tablekeys) VALUES ('$tablevalues')";
            $data=$this->mysqli->query($sql);
            if($data){
              array_push($this->result,$this->mysqli->insert_id);
              return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }

        }

    }
    public function getResult(){
        $val=$this->result;
        $this->result=array();
        return $val;
    }
    private function tableExist($table_name){
        $sql="SHOW TABLES FROM $this->db_database LIKE '$table_name'";
        $tableInDb=$this->mysqli->query($sql);
        if($tableInDb){
            if($tableInDb->num_rows==1){
                return true;
            }
            else{
                return false;
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