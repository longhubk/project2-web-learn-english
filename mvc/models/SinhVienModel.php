<?php 
  class SinhVienModel extends DB{
    public function GetSV(){
      return "Nguyen Van Teo";
    }

    public function TinhTong($m, $n){
      return $m+$n;
    }
    
    public function SinhVien(){
      $qr = "SELECT * FROM sinhvien";
      $rows = mysqli_query($this->con, $qr);
      $mang= [];
      while($row = mysqli_fetch_array($rows)){
        $mang[] = $row;
      }
      return json_encode($mang);
    }



  }

?>