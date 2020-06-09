<div id="ver_nav_2" class="right-nav">
  <div id="qs_right" class="question">
    <div class="qs_content">

      <p class="qs-title">Hướng dẫn và lưu ý</p>
      <ol class="qs-list">
        
        <?php 
          if(isset($data['tut_qs'])){
            $tut_question = $data['tut_qs'];
            foreach($tut_question as $name_user => $question){
              echo "<li><a href='#'> $question</a></li>";
            }
          }
          ?>
      </ol>
    </div>
  </div>
</div>