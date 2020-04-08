<?php 
  class Home extends Controller{

    public $sinhvien_db;
    public function __construct()
    {
      $this->sinhvien_db = $this->model("SinhVienModel");
    }
   function Init(){
      $this->view("master_h", [
        "page"   => "content_main",
    
      ]
      );
    }
    function ShowHome(){
      $this->view("master_h", [
        "page"   => "content_main",
    
      ]
      );
    }

    function Show($a, $b){
      $teo = $this->model("SinhVienModel");
      $tong =  $teo->TinhTong($a,$b);
      $this->view("aodep", [
        "number" => $tong,
        "mau"    => "red",
        "page"   => "news",
        "sothich" => ["an", "ngu", "code"],
        "SV" => $teo->SinhVien()
        

      ]
    );
      
    }
  }


?>