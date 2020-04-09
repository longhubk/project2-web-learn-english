<link rel="stylesheet" hrel="home.css" type="text/css">

<?php
  class user{
    private $UserId, $UserName, $UserMail, $UserPassword;

    public function getUserId(){
      return $this->UserId;
    }
    public function setUserId($UserId){
       $this->UserId = $UserId;
    }
    public function getUserName(){
      return $this->UserName;
    }
    public function setUserName($UserName){
       $this->UserName = $UserName;
    }
    public function getUserMail(){
      return $this->UserMail;
    }
    public function setUserMail($UserMail){
       $this->UserMail = $UserMail;
    }
    public function getUserPassword(){
      return $this->UserPassword;
    }
    public function setUserPassword($UserPassword){
       $this->UserPassword = $UserPassword;
    }
    
    public function InsertUser(){
      include "data_users.php";

      $request = $connect->prepare("INSERT INTO users(name, email, password) VALUES(:UserName, :UserMail, :UserPassword)");
      try{

        $request->execute(array(
          "UserName"=> $this->getUserName(),
          "UserMail"=> $this->getUserMail(),
          "UserPassword"=> $this->getUserPassword()
        ));
        
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }
    public function UserLogin(){
      include "data_users.php";
      $request= $connect->prepare("SELECT * FROM users WHERE email=:UserMail AND password=:UserPassword");
      $request->execute(array(
          "UserMail"=> $this->getUserMail(),
          "UserPassword"=> $this->getUserPassword()
      ));
      if($request->rowCount() == 0){
        header("Location:index.php?error=1");
        return false;
      }else{
        while($data = $request->fetch()){
          $this->setUserId($data['id']);
          $this->setUserPassword($data['password']);
          $this->setUserMail($data['email']);
          $this->setUserName($data['name']);
          header("Location:home.php");
          return true;
        }

      }
    }
  }

  class chat{
    private $ChatId, $ChatUserId, $ChatText;

    public function getChatId(){
      return $this->ChatId;
    }
    public function setChatId($ChatId){
       $this->ChatId = $ChatId;
    }
    public function getChatUserId(){
      return $this->ChatUserId;
    }
    public function setChatUserId($ChatUserId){
       $this->ChatUserId = $ChatUserId;
    }
    public function getChatText(){
      return $this->ChatText;
    }
    public function setChatText($ChatText){
       $this->ChatText = $ChatText;
    }
    
    public function InsertChatMessage(){
      include "data_users.php";
      $req = $connect->prepare("INSERT INTO chat(ChatUserId, ChatText) VALUES(:ChatUserId, :ChatText)");
      $req->execute(array(
        "ChatUserId"=> $this->getChatUserId(),
        "ChatText"=> $this->getChatText()
      ));
    }
    public function DisplayMessage(){
      include "data_users.php";
      $chatReq = $connect->prepare("SELECT * FROM chat ORDER BY Chatid ");
      $chatReq->execute();
      while($DataChat = $chatReq->fetch()){
        $UserReq = $connect->prepare("SELECT * FROM users WHERE id=:UserId");
        $UserReq->execute(array(
          "UserId" => $DataChat["ChatUserId"]
        ));
        $DataUser = $UserReq->fetch();
        ?>
        <span class="UserNames"><?php echo $DataUser['name']; ?> </span><span style="color:yellow">Says</span><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;<span class="UserMessageS" style="color: red; background-color: #f1f1f1; border-radius: 5px; padding: 1.5px; border: 2px solid #dedede;"><?php echo htmlspecialchars( $DataChat['ChatText']); ?></span><br><br>
        

        <?php
        

      }
    }

  }


?>