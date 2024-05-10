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
            if($this->mysqli->affected_rows>0){
              array_push($this->result,$this->mysqli->insert_id);
              return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }

        }

    }

    public function update($tablename,$params=array(),$where=null){
        if($this->tableExist($tablename)){
            // echo "<pre>";
            // print_r($params);
            $args=[];
            foreach($params as $key=>$value){
                $args[]="$key = '$value'";
            }
           $sql="UPDATE $tablename SET ". implode(", ",$args);

           if($where != null){
            $sql .= " WHERE $where";
           }

          if($this->mysqli->query($sql)){
            array_push($this->result,$this->mysqli->affected_rows);
            return true;
          }
          else{
            array_push($this->result,$this->mysqli->error);
            return false;
          }
        }else{
            array_push($this->result,$this->mysqli->error);
        }
    }
    public function delete(string $tablename,string $where=null){
        if($this->tableExist($tablename)){
            $sql="DELETE FROM $tablename";
            if($where !=null){
                $sql .= " WHERE $where";
            }
            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->affected_rows);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
        }else{
            return false;
        }
    }
    public function select(string $tablename,string $row="*",string $where=null,string $join=null,string $order=null,$limit=null){
        if($this->tableExist($tablename)){
            $sql="SELECT $row from $tablename";
            if($where!=null){
                $sql .= " WHERE $where";
            }
            if($join!=null){
                $sql .= " JOIN $join";
            }
            if($order!=null){
                $sql .= " ORDER BY $order ";
            }
            if($limit != null){
                $sql .= " LIMIT 0,$limit";
            }
            $data=$this->mysqli->query($sql);
            if($data){
                array_push($this->result,$data->fetch_all(MYSQLI_ASSOC));
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
            return true;
        }
        else{
            return false;
        }
    }
    public function sql($sql){
        $query=$this->mysqli->query($sql);
        if($query){
            array_push($this->result,$query->fetch_all(MYSQLI_ASSOC));
            return true;
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
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