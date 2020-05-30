$(document).ready(() => {
  let number_test = $("#number_test").html()
  for(let i = 0; i < number_test; i++){
    let id_btn = "#btn_test-"
    id_btn += i;
    console.log(id_btn)
    $(id_btn).click(() => {

      let str_split = id_btn.split('-');
      let test_id = str_split[1];

      // window.prompt("Do you want to enter this test?", "yes");
      if(confirm("Do you want to register this test?")){
        $.ajax({
          method: 'POST',
          url: "TestPage/registerTest/",
          data : {"test_id" : test_id},
          success : (res) =>{
            console.log("res" +res);
            console.log(JSON.stringify(res))
            let res_json = JSON.parse(res)
            console.log(res_json.success);
            let res_up = res_json.success[3];
            if(res_json.success == "fail"){
              console.log("Cant register !!")
            }
            if(res_up == "ok"){
              console.log("ok");
              window.location.href="TestPage/Test/"+test_id;
            }
            else if(res_up == 'fail'){
              console.log("no turn");
              alert("You can't take this test or you have no turn.")
            }

          }

        })
      }else{
        // window.location.href="TestPage/";
        console.log("fail all")
        
      }
      console.log("click " + id_btn)

    })
  }
})