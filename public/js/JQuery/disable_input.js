$(document).ready(() =>{

  let num_qs_up = $("#num_qs_up").html()

  $('#btn_test').click(() =>{
    console.log("hello");
    console.log(num_qs_up);

    for(let i = 0; i < num_qs_up; i++){
      for(let j = 1; j <= 4; j++){
        let id_hidden = "#isRightHidden-"+i+"-"+j
        let id_show = "#isRight-"+i+"-"+j
        console.log("id_hidden " + id_hidden)
        // console.log("id_show " + id_show)
        // alert("hell0")
        // console.log($(id_show).is(":checked"))

        if($(id_show).is(":checked")){
          if($(id_hidden).length){
            $(id_hidden).prop("disabled", true);
            console.log($(id_hidden).is(":disabled"))
          }
        }

  
        // if($(id_show).is(":checked")){
        //   $(id_hidden).prop("disabled", true);
        // }
      }
    }
  })
  
  $("#update_test").submit(() =>{
    for(let i = 0; i < num_qs_up; i++){
      for(let j = 1; j <= 4; j++){
        let id_hidden = "#isRightHidden-"+i+"-"+j
        let id_show = "#isRight-"+i+"-"+j
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

})