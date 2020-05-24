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
        console.log(json_data);

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error" + errorThrown);
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
        $('#tut_level').html('');
        $('#tut_level').append(json_data.success);
        $('#input_tut_level').val(json_data.success);
        console.log(json_data);

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
      $('#content_add_main').append('<hr>')
      $('#content_add_main').append("<div>Content "+i+" :</div>")
      $('#content_add_main').append("<label>Main Content:</label>")
      $('#content_add_main').append("<input class='input_content' type='text' name='main_content-"+i+"'><br><br>")
  
      $('#content_add_main').append("<label>Guide Content:</label>")
      $('#content_add_main').append("<input class='input_content' type='text' name='guide_content-"+i+"'><br><br>")
  
        for(let j = 1; j <= 5; j++){
          $('#content_add_main').append("<label>Example "+j+" :</label>")
          $('#content_add_main').append("<input class='input_content' type='text' name='exp-"+i+"-"+j+"'><br><br>")
        }
      }

    }
    else{
      $('#content_add_main').html('')
      for(let i = 1; i <= val; i++){
        $('#content_add_main').append('<hr>')
        $('#content_add_main').append("<div>Content "+i+" :</div>")
        $('#content_add_main').append("<label>Image Main:</label>")
        $('#content_add_main').append("<input class='input_content' type='text' name='image_main-"+i+"'><br><br>")
    
          for(let j = 1; j <= 3; j++){
            $('#content_add_main').append("<label>Image "+j+" :</label>")
            $('#content_add_main').append("<input class='input_content' type='text' name='img-"+i+"-"+j+"'><br><br>")
          }

        $('#content_add_main').append("<label>Content Main:</label>")
        $('#content_add_main').append("<input class='input_content' type='text' name='content_main-"+i+"'><br><br>")
    
          for(let j = 1; j <= 3; j++){
            $('#content_add_main').append("<label>Sub content "+j+" :</label>")
            $('#content_add_main').append("<input class='input_content' type='text' name='sub-"+i+"-"+j+"'><br><br>")
          }
          for(let j = 1; j <= 3; j++){
            $('#content_add_main').append("<label>Audio "+j+" :</label>")
            $('#content_add_main').append("<input class='input_content' type='text' name='aud-"+i+"-"+j+"'><br><br>")
          }
      }

    }


  })
  

})