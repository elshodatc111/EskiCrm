<?php
class Confige{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $conn;
    
    public function __construct() {
        $this->connect();
    }
    public function connect(){
        $this->host = 'localhost';
        $this->user = 'atkouz_crm';
        $this->pass = 'Elshod1997/*';
        $this->db = 'atkouz_mycrm';
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $this->conn;
    }
    public function Select($sql){
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            return true;
        }else{
            return false;
        }
    }
    public function SelectAll($sql){
        $result = $this->conn->query($sql);
        return $result;
    }
    public function SelectOne($sql){
        $result = $this->conn->query($sql);
        $rows = $result->fetch_assoc();
        return $result;
    }
    public function InsertInto($sql){
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function InsertInto2($sql,$link,$rout){
        $result = $this->conn->query($sql);
        if ($result) {
            header("location: ./".$link."?".$rout."");
        } else {
            return false;
        }
    }
    
}
$logo = "ATKO";
