$(document).ready( () =>{

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
      $append += "<table>";

      $append += "<tr>"
      $append += "<td class='title_content'>Main Content</td>"
      $append += "<td class='input_content'><textarea  name='main_content-"+i+"'></textarea>";
      $append += "</tr>"

      $append += "<tr>"
      $append += "<td class='title_content'>Guide Content</td>"
      $append += "<td class='input_content'><textarea  name='main_content-"+i+"'></textarea>";
      $append += "</tr>"
      

      for(let j = 1; j <= 5; j++){
          $append += "<tr>"
          $append += "<td class='title_content' >Example "+j+" :</td>"
          $append += "<td class='input_content'><textarea   name='exp-"+i+"-"+j+"'></textarea></td>"
          $append += "</tr>";
      }

      $append += "</table>";
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
  

})