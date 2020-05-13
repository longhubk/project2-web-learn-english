<?php 
 
;  class DB{
    public $con;
    public $con_mongo;
    protected $serverName = "localhost";
    protected $password   = "PtOGOOZuHq7aV4Pi";
    protected $dbname     = "speakmore";
    protected $username   = "root";

    function __construct(){
      $this->con = mysqli_connect($this->serverName, $this->username, $this->password);
      mysqli_select_db($this->con, $this->dbname);
      mysqli_query($this->con, "SET NAMES 'utf-8'");
  }
    public function readJsonData($path){
      $file         = fopen($path, "r") or die("can't open file");
      $file_read    = fread($file, filesize($path));
      $file_decoded = json_decode($file_read);
      fclose($file);
      return $file_decoded;
    }

  }
      


?>