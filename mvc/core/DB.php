<?php 

;  class DB{
    protected $con;
    // public $con_mongo;
    protected $serverName = "localhost";
    protected $password   = "PtOGOOZuHq7aV4Pi";
    protected $dbname     = "speakmore";
    protected $username   = "root";

    function __construct(){
      $this->con = mysqli_connect($this->serverName, $this->username, $this->password);
      mysqli_select_db($this->con, $this->dbname);
      mysqli_query($this->con, "SET NAMES 'utf-8'");
  }
    protected function readJsonData($path){
      $file         = fopen($path, "r") or die("can't open file");
      $file_read    = fread($file, filesize($path));
      $file_decoded = json_decode($file_read);
      fclose($file);
      return $file_decoded;
    }

    
    protected function queryAllArray($qr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }

    protected function queryAssoc($qr, $tr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_assoc($rows);
      return $res[$tr];
    }

  }
      


?>