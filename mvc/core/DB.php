<?php 
  class DB{
    public $con;
    protected $servername = "localhost";
    protected $password = "PtOGOOZuHq7aV4Pi";
    protected $dbname = "mvc";
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

  }
      


?>