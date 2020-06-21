<?php

  if(isset($data['info_user'])){
    $info_user   = $data['info_user'];
    $us_fname    = $info_user['fname'];
    $us_lname    = $info_user['lname'];
    $us_birthday = $info_user['birthday'];
    $us_gender   = $info_user['gender'];
    $us_school   = $info_user['school'];
    $us_toeic    = $info_user['toeic'];

    $out = "";
    $out .= "<table>
      <tr>
        <td>Ten:</td>
        <td>".$us_fname."</td>
      </tr>

      <tr>
        <td>Ten Dem:</td>
        <td>".$us_lname."</td>
      </tr>

      <tr>
        <td>Gioi Tinh:</td>
        <td>".$us_gender."</td>
      </tr>

      <tr>
        <td>Ngay Sinh:</td>
        <td>".$us_birthday."</td>
      </tr>

      <tr>
        <td>Truong hoc:</td>
        <td>".$us_school."</td>
      </tr>

      <tr>
        <td>Diem Toeic:</td>
        <td>".$us_toeic."</td>
      </tr>

    
    ";
  

    $out .= "</table>";

    echo $out;
  }
  else 
    echo "Empty"


?>