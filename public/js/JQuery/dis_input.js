$(document).ready(() =>{

  if($('#num_qs_test').length){
    let num_qs_test = $("#num_qs_test").html()

    $("#submit_test_form").submit(() =>{
      for(let i = 0; i < num_qs_test; i++){
        for(let j = 1; j <= 4; j++){
          let id_hidden = "#ans_hide-"+i+"-"+j
          let id_show = "#ans_show-"+i+"-"+j
          // console.log("id_hidden " + id_hidden)
          // console.log("id_show " + id_show)
          // alert("hell0")
    
          if($(id_show).is(":checked")){
            if($(id_hidden).length){
              $(id_hidden).prop("disabled", true);
              console.log($(id_hidden).is(":disabled"))
            }
          }
        }
      }
      return true;
    })
  }

})