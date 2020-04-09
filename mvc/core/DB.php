<?php 
  class DB{
    public $con;
    protected $servername = "localhost";
    protected $password = "PtOGOOZuHq7aV4Pi";
    protected $dbname = "speakmore";
    protected $username = "root";

    function __construct(){
    
      //  $options = array(
      //   PDO::ATTR_PERSISTENT => true,
      //   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      // );
      
      // try{
      //   $this->con = new PDO("mysql:host=". $this->servername .";dbname=". $this->dbname, $this->username, $this->password , $options);

      // } catch (PDOException $e){
      //   $this->error = $e->getMessage();

      $this->con = mysqli_connect($this->servername, $this->username, $this->password);
      mysqli_select_db($this->con, $this->dbname);
      mysqli_query($this->con, "SET NAMES 'utf-8'");

    }
    public function readJsonData($path){
      $file = fopen($path, "r") or die("can't open file");
      $file_read = fread($file, filesize($path));
      $file_decoded = json_decode($file_read);
      fclose($file);
      return $file_decoded;
    }

  }
      


?>