
<div class="main-container">
  <div class="video-card">

    <h1>Test Page </h1>
    <p>Đây là danh sách các bài thi:</p>
    <?php
      
      if(isset($data['all_test'])){
        $all_test = $data['all_test'];
        foreach($all_test as $key => $value){
          echo "<a href='./TestPage/".$key."/0'>".$value."</a><br>";
        }
      }
    
    ?>

  </div>
</div>