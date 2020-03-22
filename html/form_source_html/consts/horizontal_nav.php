<ul id="hor-nav" class="hori-nav">
  <li id="home-li"><a href="index.php"><i class="fa fa-fw fa-home"></i>HOME</a></li>
  <li><a href="#">NOTIFICATIONS</a></li> 
  <li class="tutorial">
    <a href="#" class="dropbtn">
      TUTORIALS
      <i class="fa fa-caret-down"></i>
    </a>
    <div class="inner-content"> 
      <?php
        $tutorial_list = read_json("../../data/tutorials/all_tutorial.json");
        foreach($tutorial_list as $tutorial_item => $name){
            echo "<a href='../form_index/index.php?tutorial=$tutorial_item'>$name</a>";
        }
      ?>
    </div>
  </li>
  <li><a href="#">TESTS</a></li>
  <li><a href="#">DOCUMENTATIONS</a></li>
  <li><a href="#">RESOURCES</a></li>
  <li><a href="#">ABOUT US</a></li>
  <li id=search_area>
    <div class="search-box" style="margin-left: 10px;">
      <i class="fa fa-search" style="color: white;"></i>
      <input id="search" type="text" placeholder="Search on page">
      <button class="btn-search">Search</button>
    </div>
  </li>
</ul>