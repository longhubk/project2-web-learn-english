
  <?php 
  class Register extends Controller{

    public $sinhvien_db;
    public $user_db;
    public function __construct()
    {
      $this->sinhvien_db = $this->model("SinhVienModel");
      $this->user_db = $this->model("UserModel");
    }
    function SayHi(){
      $this->view("aoxau", [
        "page"   => "login",
        "SV" => $this->sinhvien_db->SinhVien()

      ]
      );
    }
    function KhachHangDangKy(){
      // $this->view("aoxau", [
      //   "page"   => "login",
      //   "SV" => $this->sinhvien_db->SinhVien()

      // ]
      // );
      echo "khach hang dang ky";
      //* get data customeer
      if(isset($_POST["register"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $name = $_POST["name"];
        $email = $_POST["email"];
        $address = $_POST["address"];

        $kq = $this->user_db->InsertUser($username, $password, $name, $address, $email );
        echo $kq;

        $this->view("aoxau", [
          "page"   => "login",
          "SV" => $this->sinhvien_db->SinhVien(),
          "result" => $kq
  
        ]
        );
      }

      //* insert database
      
      //* show ok or fail
    }
}

    ?>