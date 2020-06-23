<?php 

  class Database{
    protected $con;
    protected $path = "./mvc/models/data/";

    private $serverName = "localhost";
    private $password   = "PtOGOOZuHq7aV4Pi";
    private $dbname     = "speakmore";
    private $username   = "root";

    public function __construct(){
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

    protected function queryAssocAll($qr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_assoc($rows);
      return $res;
    }

    protected function queryAssoc($qr, $tr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_assoc($rows);
      return $res[$tr];
    }

    protected function queryNumRow($qr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_num_rows($rows);
      return $res;
    }

    protected function queryOne($qr){
      $res = mysqli_query($this->con, $qr);
      return $res;
    }

    protected function  stripVN($str) {

    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/ /", "_", $str);
    return $str;

  }

  protected function filterBreak($str){
    return preg_replace("/\r\n/", "<br>\n", $str);
  }

  protected function uploadFile($f_name, $ft_name, $new_name, $f_size, $f_err, $f_Ext_Allowed, $f_dir){
        $res = false;
        $f_Ext        = explode('.', $f_name);
        $f_Actual_Ext = strtolower(end($f_Ext));
        $f_new_name   = $new_name .".". $f_Actual_Ext;

        $f_des = $f_dir . $f_new_name;
  
        $out = '';
        
        if(in_array($f_Actual_Ext, $f_Ext_Allowed)){
          if($f_err == 0){
            if($f_size < 5000000){
              move_uploaded_file($ft_name, $f_des);
              $this->check_name_file_exist($new_name, $f_Ext_Allowed, $f_Actual_Ext, $f_dir);
            }else
              $out = "file bigger than 5M";
          }else
            $out = "There are error";
        }
        else
          $out = "you can not upload file that is not allowed extensions";
      if(empty($out)) return $f_new_name;
      else return $out;
  }

  protected function check_name_file_exist($f_name, $f_Ext_Allowed, $f_Actual_Ext, $f_dir){
    foreach($f_Ext_Allowed as $ext){
      if($ext !== $f_Actual_Ext){
        $f_name_check = $f_dir . $f_name ."." . $ext;

        if(file_exists($f_name_check)){
          unlink($f_name_check);
          echo "Deleted your old file ".$f_name." <br>";
        }
      }
    }
  }

}
      


?>