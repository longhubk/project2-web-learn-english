<?php 
 
;  class DB{
    public $con;
    public $con_mongo;
    protected $servername = "localhost";
    protected $password   = "PtOGOOZuHq7aV4Pi";
    protected $dbname     = "speakmore";
    protected $username   = "root";

    function __construct(){
    
      $this->con = mysqli_connect($this->servername, $this->username, $this->password);
      mysqli_select_db($this->con, $this->dbname);
      mysqli_query($this->con, "SET NAMES 'utf-8'");

      // $client = new MongoDB\Client(
      //   'mongodb+srv://Longbk:atlas@cluster0-0lgum.mongodb.net/test?retryWrites=true&w=majority');
      // $this->con_mongo = $client->test;
      // echo "connect_mongo success";
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