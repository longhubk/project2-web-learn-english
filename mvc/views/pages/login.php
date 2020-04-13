<h2>regisger</h2>
<form method="POST" action='./Register/KhachHangDangKy'>
  <div class="form-group" >
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" id="usernameid" aria-describedby="emailHelp" name="username">
    <div id='messageid'></div>
 
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address">
 
  </div>

  <button type="submit" class="btn btn-primary" name="register">Register</button>
</form>

<?php if(isset($data['result'])){ ?>
<h3>
  <?php if($data['result'] == "true"){
    echo "Dang Ki Thanh Cong";
  }else{

    echo "Dang Ki That Bai";
  } ?>
</h3>
<?php } ?>