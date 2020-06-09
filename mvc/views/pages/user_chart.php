

<div class='main-container'>

  <div class="user_info_page_2">
  <?php

    if(isset($data['point_test'])){
      $point_test = $data['point_test'];
      // var_dump($point_test);
      
      $tb1 = 
      "<table class='table_style2'>
        <tr class='first_row'>
          <td colspan='3'>Test table</td>
        </tr>
        <tr >
          <td>Name Test</td>
          <td>Date do test</td>
          <td>Point</td>
        </tr>";

    for($i = 0; $i < sizeof($point_test); $i++){
      $tb1 .= 
      "<tr>
        <td>".$point_test[$i][3]."</td>
        <td>".$point_test[$i][2]."</td>
        <td>".$point_test[$i][1]."</td>
      </tr>";
    }
    $tb1 .= "</table>";
    echo $tb1;
    }


    echo "<div class='clear'></div>";

    if(isset($data['point_les'])){
      $point_les = $data['point_les'];
      // var_dump($point_les);

      $tb1 = 
      "<table class='table_style2'>
        <tr class='first_row'>
          <td colspan='3'>Total point in lesson</td>
        </tr>
        <tr >
          <td>Name lesson</td>
          <td>Date do test</td>
          <td>Point</td>
        </tr>";

    for($i = 0; $i < sizeof($point_les); $i++){
      $tb1 .= 
      "<tr>
        <td>".$point_les[$i][3]."</td>
        <td>".$point_les[$i][2]."</td>
        <td>".$point_les[$i][1]."</td>
      </tr>";
    }
    $tb1 .= "</table>";
    echo $tb1;
    }

  
  ?>

  </div>
</div>