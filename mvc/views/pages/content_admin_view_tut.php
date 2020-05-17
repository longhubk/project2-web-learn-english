  
<div class="admin_container">
  <h2>All Current Tutorial:</h2>
  <?php
    if(isset($data['num_lesson'])){
      // var_dump($data['num_lesson']);
    }

    if( isset($data['all_tutorial']) && 
        isset($data['num_lesson']) &&
        isset($data['all_lesson']) &&
        isset($data['admin_modify'])){

      // var_dump($data['all_lesson']);
      // var_dump($data['all_tutorial']);
      $num_lesson = $data['num_lesson'];
      $all_tut    = $data['all_tutorial'];
      $name_ad    = $data['admin_modify'];
      $all_lesson = $data['all_lesson'];

      for($i = 0; $i < sizeof($all_tut); $i++){
        echo "<a href='#'>".$all_tut[$i][1]."</a><br>";
        
        for($j = 0; $j < sizeof($num_lesson); $j++){
          if($num_lesson[$j][0] == $all_tut[$i][0])
            echo "Number lesson: ".$num_lesson[$i][1]. "    ";
        }
        echo "<i title='show lesson' class=' show_lesson fas fa-eye'></i><br>";
        ?>

        <div class="toggle_lesson">

        <?php
        $count_les_tut = 0;
          for($j = 0; $j < sizeof($all_lesson); $j++){
            if($all_lesson[$j][1] == $all_tut[$i][0]){
              $count_les_tut++;
              echo "<div>".$count_les_tut. " : " .$all_lesson[$j][3] ;
              echo "<a title='update lesson' href='./HomeAdmin/getUpdateLesson/".$all_lesson[$j][0]."'><i class='material-icons setting_lesson'>settings</i></a>";
              echo "</div>";
            }
            
          }

        ?>

        </div>
        

        <?php
        for($j = 0; $j < sizeof($name_ad); $j++){
          if($name_ad[$j][0] == $all_tut[$i][2])
            echo "Modify by: ".$name_ad[$i][1]." <br>";
          else
            echo "Modify by: unknown <br>";
        }


        echo "Date modifiy: ".$all_tut[$i][3]." <br>";

      }
    }

  ?>
</div>
  