<div class="main-container">
  <div class="video-card">

    <!-- <h1>This is doc main</h1> -->
    <?php 
      
      if(isset($data['all_doc_page'])){
        $all_doc = $data['all_doc_page'];
        
        if(isset($data['doc_Category_name']))
          echo "<h1>".$data['doc_Category_name']."</h1>";
        $doc_ca_name = $data['doc_ca_name'];

        for($i = 0; $i < sizeof($all_doc); $i++){
          $doc_img  = $all_doc[$i][6];
          $doc_name = $all_doc[$i][3];
          $doc_date = $all_doc[$i][4];
          $doc_link = $all_doc[$i][5];
          $doc_des  = "";
          $doc_ad_name = $all_doc[$i][8];

          if(!empty($all_doc[$i][7]))
            $doc_des = $all_doc[$i][7];
            $doc_des = $all_doc[$i][7];

          echo "<div class='each_tut_show'>
            <div class='tut_img'>
              <img class='img_tut_show  img-100' src='public/img/doc_img/".$doc_img."'>
            </div>

            <div class='tut_cont'>
              <div class='title'>
                <a href='DocsPage/Read/".$doc_ca_name."/".$doc_link."'>";
                  echo $doc_name;
                echo "</a>
              </div>

              <div class='des_tut'>";
                echo $doc_date;
              echo"</div>

              <div class='des_tut'>Đăng bởi<i> ";
                echo $doc_ad_name;
              echo"</i></div>

              <div class='des_tut'>";
                echo $doc_des;
              echo"</div>

            </div>
          
          </div><br>";

        }

      }
    

      if(isset($data['doc_content'])){
        $doc_ct = $data['doc_content'];

        $out = "<div class='doc_ct_contain'>";

        if(isset($data['doc_name_title']))
          $out .= "<h1>".$data['doc_name_title']."</h1>";

        // var_dump($doc_ct);
        for($i = 0; $i < sizeof($doc_ct); $i++){
          $doc_text = $doc_ct[$i][2];
          // echo $doc_text;
          $doc_img = $doc_vid = $doc_aud = '';
          if(!empty($doc_ct[$i][3]))
            $doc_img  = "public/img/doc_img/" . $doc_ct[$i][3];

          $out .=  "
            <div class='each_doc_ct'>
              <p>".$doc_text."</p>";
          if(file_exists($doc_img))
            $out .= "<img class='intro' src='$doc_img'>";

          $out .="</div>";

        }
        $out .= "</div>";
        echo $out;
      }
    
    ?>

  </div>
</div>