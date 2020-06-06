$(document).ready( () =>{

  let global_num_ex = 0;
  for(let i = 1; i <= 10; i++){
    let id_ex = 'img#add_ex_'+i
    let id_ex2 = 'img#add_ex2_'+i
    let id_rm = 'img#rm_ex_'+i
    let id_rm2 = 'img#rm_ex2_'+i
    let id_ct = '#content_'+i+ " tr"
    let id_tb = '#content_'+i
    $(document).on("click",id_ex,() => {
      let num_ex = $(id_ct).length - 2
      console.log("hello")
      console.log('num_curr_row: ' + num_ex)
      let append = ''
      if(num_ex < 10){
        append += "<tr><td class='title_content'>Example "+(num_ex+1)+"</td><td class='input_content'><textarea   name='exp-"+i+"-"+(num_ex+1)+"'></textarea></td></tr>";
        console.log(append)
        $(id_tb).append(append)
      }
    })
    $(document).on("click",id_ex2,() => {
      let num_ex = $(id_ct).length - 2
      console.log("hello")
      console.log('num_curr_row: ' + num_ex)
      let content_id = $(id_ex2).data('content_id')
      let append = ''
      if(global_num_ex == 0){
        global_num_ex = $(id_ct).length
      }
      if(num_ex < 10){
        append += "<tr><td>Example "+(num_ex+1)+"</td><td class='input_content'><textarea   name='example_"+(num_ex+1)+"-"+content_id+"'></textarea></td></tr>";
        console.log(append)
        $(id_tb).append(append)
      }
    })
    $(document).on("click", id_rm, () => {
      let num_ex = $(id_ct).length - 2
      if(num_ex > 0){
        $(id_ct + ":last").remove()
      }
    })



    $(document).on("click", id_rm2, () => {
      if(global_num_ex > 0){
        let num_ex = $(id_ct).length

        if(num_ex > global_num_ex){
          $(id_ct + ":last").remove()
        }
      }
    })

  }
  // $('#add_ex_')

  $('#select_tut').on('change', () =>{
    let val = $('#select_tut').val()
    // alert('val change to ' + val)
    $.ajax({
      url     : "./HomeAdmin/getLessonOfTutorial",
      type    : 'POST',
      data : {'id' : val},
      success : (res) =>{
        let json_data = JSON.parse(res) 
        // alert("success : " + json_data[0][0] + " and " + json_data[0][1]); 
        
        $('#select_les').html('');
        for(let i = 0; i < json_data.length; i++) {
            $('#select_les').append("<option value='"+ json_data[i][1] +"'>"+ json_data[i][0] +"</option>")
        }
        console.log(json_data)

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error" + errorThrown)
      } 
      
    })


  })

  $('#select_les').on('change', () => {
    $('#choose_number').trigger("click")
  })


  $('#select_tut').on('change', () =>{

    let val = $('#select_tut').val()
    $.ajax({
      url     : "./HomeAdmin/getTutLevel",
      type    : 'POST',
      data : {'id' : val},
      success : (res) =>{
        let json_data = JSON.parse(res) 
        $('#tut_level').html('')
        $('#tut_level').append(json_data.success)
        $('#input_tut_level').val(json_data.success)
        $('#choose_number').trigger("click")
        console.log(json_data)

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error" + errorThrown);
      } 
      
    })


  })


  $('#choose_number').on('keyup click', () => {
    let val = $('#choose_number').val()
    // alert('val change to ' + val)
    let tut_level = $('#tut_level').html()
    // alert("tut_level :" +tut_level)
    if(tut_level > 0){

      $('#content_add_main').html('')

      for(let i = 1; i <= val; i++){
      $append = "";
      $append += "<hr>";
      $append += "<div>Content "+i+" :</div>";
      $append += "<table id='content_"+i+"'>";

      $append += "<tr>"
      $append += "<td class='title_content'>Main Content</td>"
      $append += "<td class='input_content'><textarea  name='main_content-"+i+"'></textarea>";
      $append += "</tr>"

      $append += "<tr>"
      $append += "<td class='title_content'>Guide Content</td>"
      $append += "<td class='input_content'><textarea  name='guide_content-"+i+"'></textarea>";
      $append += "</tr>"
      

      for(let j = 1; j <= 3; j++){
          $append += "<tr>"
          $append += "<td class='title_content' >Example "+j+" :</td>"
          $append += "<td class='input_content'><textarea   name='exp-"+i+"-"+j+"'></textarea></td>"
          $append += "</tr>";
      }
      $append += "</table>";
      $append += "<img class='icon-96' id='add_ex_"+i+"' src='public/icon/plus_green_icon.png'>";
      $append += "<img class='icon-96' id='rm_ex_"+i+"' src='public/icon/minus_red_icon.png'>";

      $('#content_add_main').append($append)
    }
  }
    else{
      $('#content_add_main').html('')
      for(let i = 1; i <= val; i++){
        $append = ""

        $append += '<hr>'
        $append += '<table class="table_new_les_basic">'

        $append += "<div >Content "+i+" :</div>"
        $append += "<tr><td class='title_content'>Image Main</td>"
        $append += "<td class='input_content'><input type='file' accept='.jpg,.png,.gif,.jpeg' name='image_main-"+i+"'></td>"
        $append += "</tr>"
          for(let j = 1; j <= 3; j++){
            $append += "<tr>"
            $append += "<td class='title_content'>Image "+j+" :</td>"
            $append += "<td class='input_content'><input  type='file' accept='.jpg,.png,.gif,.jpeg' name='img-"+i+"-"+j+"'></td>"
            $append += "</tr>"
          }

        $append += "<tr><td class='title_content'>Content Main:</td>"
        $append += "<td class='input_content'><textarea placeholder='Enter content main...'  name='content_main-"+i+"'></textarea></td>"
        $append += "</tr>"
    
          for(let j = 1; j <= 3; j++){
            $append +="<tr><td class='title_content'>Sub content "+j+" :</td>"
            $append +="<td class='input_content'><textarea placeholder='Enter sub content "+j+"...' name='sub-"+i+"-"+j+"'></textarea></td>"
            $append += "</tr>"
          }
          for(let j = 1; j <= 3; j++){
            $append +="<tr><td class='title_content'>Audio "+j+" :</td>"
            $append +="<td class='input_content'><input type='file' accept='.mp3,.m4a' name='aud-"+i+"-"+j+"'></td>"

            $append += "</tr>"
          }
        $append += '</table>'
        $('#content_add_main').append($append)
      }
    }

  })

  $('#test_click').click(function(){
    console.log("hello");
  })
  

})