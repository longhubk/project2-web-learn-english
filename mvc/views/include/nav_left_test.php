<div id="ver_nav" class="ver-bar">

  <div class='clock_contain'>


    
    <button id='disable_redirect' style="display: none;"></button>

    <?php

      
      echo "<table>"; 
      if(isset($data['test_qs'])){
        $test_qs = $data['test_qs'];
        echo "<tr>
        <td>Number question</td>
        <td id='num_qs_test' >".sizeof($test_qs)."</td>
        </tr>
        ";
      }

      if(isset($data['time_test'])){
        $time_test = $data['time_test'];
        echo "<tr>
          <td>Time</td>
          <td><div id='status'><span id='time_test' >".$time_test."</span>  : 00  </div></td>
        </tr>";
        // echo "<div>Time : <span id='time_test' >".$time_test."</span> (phút)</div>";

        echo "<tr>
              <td></td>
              <td><button id='btn_trigger'>start</button> </td>
          </tr>";
      }
      echo "</table>";
      
    ?>

  </div>

  <div class='list_question'>
    <ul>
      <?php
        if(isset($data['test_qs'])){
          $test_qs = $data['test_qs'];
          if(!empty($test_qs)){
            for($i = 0; $i < sizeof($test_qs); $i++){
                $id_qs      = $test_qs[$i][0];
                $name_qs    = $test_qs[$i][1];
              echo "<li id='check_small-".$i."'><label>".$name_qs."</label> <input type='checkbox' name='check_box_qs' ></li>";
            }
          }
        }
        else
        if(isset($data['all_test'])){
          $all_test = $data['all_test'];
          if(!empty($all_test)){
            for($i = 0; $i < sizeof($all_test); $i++){
              $name_test    = $all_test[$i][1];
              echo "<li id='test-small".$i."'><label>".$name_test."</label></li>";
            }
          }
        }
      ?>
    </ul>
  </div>
</div>