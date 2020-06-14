$(document).ready(() => {

  
  if($('#tut_id').length && $('#les_id').length){

  let tut_id = $("#tut_id").html()
  
  let les_id = $("#les_id").html()

  let tut_arr_id = tut_id.split(',')
  let les_arr_id = les_id.split(',')

  for(let i = 0; i < tut_arr_id.length; i++){
    for(let j = 0; j < les_arr_id.length; j++){
      let del_id = "#delete_lesson-"+les_arr_id[j] +"-"+tut_arr_id[i];
      let edit_les = "#edit_lesson-"+i+"-"+j;
      let toggle_edit_les = "#toggle_edit_les-"+i+"-"+j;
      $(toggle_edit_les).hide()

      $(del_id).click(() => {
          console.log(del_id + "clicked")

          if(confirm('Are you sure to delete this lesson?')){
            // console.log("deleted")
            $.ajax({
              url : "./AdminPage/getDeleteLesson",
              method: 'POST',
              data : {tutId: tut_arr_id[i], lesId: les_arr_id[j]},
              success : (data) => {
                let res = data.trim()
                console.log("res : "+ res);
                if(res == "ok"){
                  alert("Lesson have deleted !!")
                  location.reload()
                }
                else
                  alert("Deleting error !!")

              }
            })
          }else{
            alert("So Be careful !!!")
          }

        })

        $(edit_les).click(() => {
          if($(toggle_edit_les).is(':visible'))
            $(toggle_edit_les).fadeOut(400)
          else
          $(toggle_edit_les).fadeIn(500)

          for(let k = 0; k < tut_arr_id.length; k++){
            for(let m = 0; m < les_arr_id.length; m++){
              let other_edit_les = "#edit_lesson-"+k+"-"+m;
              let other_toggle_edit_les = "#toggle_edit_les-"+k+"-"+m;

              if(other_edit_les != edit_les){
                $(other_toggle_edit_les).css('display', 'none')
              }

            }
          }

        })


      }
    }
    
  }

})