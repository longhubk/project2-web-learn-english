<div id="ver_nav_2" class="right-nav">
  <div id="qs_right" class="question">
    <div class="qs_content">

      <p id="txtSuggest" class="qs-title">Top Question</p>
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