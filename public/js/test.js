var countDownDate = new Date();
var countDownDate2 = new Date(countDownDate)

let time_of_test = document.getElementById('time_test')
let time_test = 0;
if(time_of_test != null)
  time_test = Number(time_of_test.innerHTML);
// console.log(time_test)

countDownDate2.setMinutes(countDownDate.getMinutes() + time_test);

countDownDate3 = countDownDate2.getTime()
let btn_click = document.getElementById('btn_trigger')


    function listener(event) {
      event.returnValue = `Are you sure you want to leave?`;
      $(document).ready(() =>{
        $.ajax({
          method : "POST",
          url : "TestPage/destroySessionTest",
          data : {"destroy" : "ok"},
        })
      }
    )}

$(document).ready(() =>{
  $('#btn_trigger').click(() =>{
    setTimeTest();
    $('#btn_trigger').hide()
    $('#test_ready_hide').hide()


    window.addEventListener('beforeunload', listener);

    $('#toggle_start').show()

  })

  $('#disable_redirect').click(function() {

    window.removeEventListener('beforeunload', listener);

    console.log("hello");

  });

  $('#submit_test_form').submit(() =>{
    $('#disable_redirect').trigger('click');
      $.ajax({
        method : "POST",
        url : "TestPage/destroySessionTest",
        data : {"destroy" : "ok"},
      })

  })

  $('.btn_trigger_qs').click(() => {
    $('#disable_redirect').trigger('click');
  })

  let num_question = $('#num_qs_test').html()
  console.log('num--------------------------------->' + num_question)

  for(let i = 0 ; i < num_question; i++){
    let id = '#ans_show-'+i
    for(let j = 1; j <= 4; j++){
      let id2 = id +  "-" + j
      console.log( "iiiiiiiiiiiiii---->"+ id2)
      $(id2).click(() => {
        let id_sm = "#check_small-" + id2.split('-')[1]

        if($(id2).is(":checked")){
          console.log(id2 + " is checked");
          console.log(id_sm + "is red")
          $(id_sm).css('background-color', 'red')

        }
        else{

          let id_now = id2.split('-')[2]
          let id_now_f = id2.split('-')[0]
          let id_now_m = id2.split('-')[1]
          console.log(id2 + " is unchecked");
          console.log(id_sm + "is green")
          $(id_sm).css('background-color', 'green')

          for(let k = 1; k <= 4; k++){
            if(k != id_now){
              let id_other = id_now_f + "-" + id_now_m + "-"+ k
              if($(id_other).is(':checked')){
                $(id_sm).css('background-color', 'red')
              }
            }
          }

        }
      })      

    }
  }

}) 





function setTimeTest(){

  // $(document).ready(() =>{
  //   $(window).bind('beforeunload', function() {
  //     $.ajax({
  //       method : "POST",
  //       url : "TestPage/destroySessionTest",
  //       data : {"destroy" : "ok"},
  //     })
  //   })
  // });


  function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

  $(document).ready(function(){
    $(document).on("keydown", disableF5);
  });
  
  let x =  setInterval(function() {

    var now = new Date().getTime();
    var distance = countDownDate3 - now;
      
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
      document.getElementById("status").innerHTML =  minutes + " : " + seconds ;
      
      if (distance < 0) {
      clearInterval(x);
      document.getElementById("status").innerHTML = "EXPIRED";
      $(document).ready(() =>{
        // $('#trigger_test').trigger('click')
        $('#submit_test_form').trigger('submit')

      })

      }
  }, 1000);

}