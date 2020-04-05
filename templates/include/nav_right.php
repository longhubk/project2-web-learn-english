<div id="ver_nav_2" class="right-nav">
  <div id="qs_right" class="question">
    <p id="txtSuggest" class="qs-title">Top Question</p>
    <ol class="qs-list">
      <?php
      include "../php/question_prs.php";
      ?>
    </ol>
  </div>
  <div id="cal" class="calendar">
    <div class="title">
      <div class="name-calendar">
        <i class="fa fa-calendar" style="color: browser;"></i>
        <p>Calendar</p>
      </div>
    </div>
    <div id="time"></div>
    <div class="month">
      <button id="mon-prev">prev</button>
      <div id="month">March</div>
      <button id="mon-next">next</button>
    </div>
    <div id="day">
    </div>
  </div>
</div>