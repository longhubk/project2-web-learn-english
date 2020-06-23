<div id="ver_nav_2" class="right-nav">
  <div id="qs_right" class="question">
    <div class="qs_content">

      <?php 
      if(isset($data['test_guide']))
        echo "<p id='txtSuggest' class='qs-title'>Hướng dẫn</p>";
      else
        echo "<p id='txtSuggest' class='qs-title'>Top bài viết</p>";
      ?>

      <ol class="qs-list">
        <?php 
      
          if(isset($data['test_guide'])){
            $test_guide = $data['test_guide'];
            foreach($test_guide as $name_guide => $guide)
              echo "<li>$guide</li>";

          }
          else
          if(isset($data['all_doc'])){
            $all_doc = $data['all_doc'];
            for($i = 0; $i <sizeof($all_doc); $i++)
              echo "<li><a href='DocsPage/Read/".$all_doc[$i][7]."/".$all_doc[$i][5]."'> ".$all_doc[$i][3]."</a></li>";
          }
          ?>
      </ol>
    </div>
  </div>
  <div id="cal" class="calendar">
    <div class="title">
      <div class="name-calendar">
        <img class="icon-20 icon_calendar" src='public/icon/calendar_icon.png'>
        Calendar
      </div>
    </div>
    <div id="time"></div>
    <div class="month">
      <!-- <button onclick="setMonthDown()" id="mon-prev">prev</button> -->

      <div  id="day_m"></div>
      <div  id="month"></div>
      <div  id="year_m"></div>
      <!-- <button onclick="setMonthUp()"id="mon-next">next</button> -->
    </div>
    <div id="day">
    </div>
  </div>
</div>