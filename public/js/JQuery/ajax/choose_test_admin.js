

$(document).ready(() =>{
  let global_test_id = 0
  let global_test_level = 0

  $('#select_test').on('change', () =>{
    let val = $('#select_test').val()
    // alert('val change to ' + val)
    global_test_id = val
    $.ajax({
      url     : "./AdminPage/getCurrentNumQuestionOfEachTest",
      type    : 'POST',
      data : {'id' : val},
      success : (res) =>{
        // console.log(res)
        let json_data = JSON.parse(res) 
        // alert("success : " + json_data[0][0] + " and " + json_data[0][1]); 
        
        // console.log(json_data.test_curr[3])

            let max_qs_can_add = json_data.test_curr[3] - json_data.curr_num_qs
            // console.log(max_qs_can_add);
            $('#choose_number_qs').attr("max" , max_qs_can_add)
            $('#max_num_qs').html(max_qs_can_add)
            $('#test_level').html(json_data.test_curr[7])
            $('#input_test_level').attr( "value", json_data.test_curr[7])

            global_test_level = json_data.test_curr[7]

            // console.log("g_id"+ global_test_id)
            // console.log("g_level"+ global_test_level)
            $('#dynamic_link').attr('href', 'AdminPage/getUpdateTest/'+ global_test_id + "/" + global_test_level)

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error" + errorThrown);
      } 
      
    })


  })

  $('#choose_number_qs').on('keyup click', () => {
    let val = $('#choose_number_qs').val()
    // alert('val change to ' + val)
    let test_level = $('#test_level').html()
    // alert("tut_level :" +tut_level)
    if(test_level > 0){

      // $('#content_add_main').html('')
      // for(let i = 1; i <= val; i++){
      // $('#content_add_main').append('<hr>')
      // $('#content_add_main').append("<div>Content "+i+" :</div>")
      // $('#content_add_main').append("<label>Main Content:</label>")
      // $('#content_add_main').append("<input class='input_content' type='text' name='main_content-"+i+"'><br><br>")
  
      // $('#content_add_main').append("<label>Guide Content:</label>")
      // $('#content_add_main').append("<input class='input_content' type='text' name='guide_content-"+i+"'><br><br>")
  
      //   for(let j = 1; j <= 5; j++){
      //     $('#content_add_main').append("<label>Example "+j+" :</label>")
      //     $('#content_add_main').append("<input class='input_content' type='text' name='exp-"+i+"-"+j+"'><br><br>")
      //   }
      // }

    }
    else{

      $('#content_add_main').html('')
      let outPut = '';
      for(let i = 1; i <= val; i++){

        outPut += "<hr><table id='table_test_"+i+"' class='table_new_content'>"

        outPut += "<tr class='first_row'><td class='first_column'>Question "+i+" </td><td class='middle_column'>Content</td><td class='last_column'>Right answer</td></tr>"

        outPut += "<tr><td class='first_column'>Name question</td><td class='middle_column input_content'><textarea name='name-"+i+"'></textarea></td><td></td></tr>"

        outPut += "<tr><td class='first_column'>Content question</td><td class='middle_column input_content'><textarea class='area_content'  name='question-"+i+"'></textarea></td><td></td></tr>"

          for(let j = 1; j <= 4; j++){
            outPut += "<tr><td class='first_column'>Answer "+j+"</td><td class='middle_column input_content'> <textarea  name='ans_"+j+"-"+i+"'></textarea></td><td class='last_column'><input class='check_content' value='true' type='checkbox' name='isRight_"+j+"-"+i+"'></td><tr></tr>"
          }
        outPut += "</table>"

        $('#content_add_main').append(outPut)
        // $('#table_test_'+i).fadeOut(500).fadeIn(5000)
      }

    }


  })

})