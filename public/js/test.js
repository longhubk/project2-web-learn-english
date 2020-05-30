var countDownDate = new Date();
var countDownDate2 = new Date(countDownDate)

let time_test = Number(document.getElementById('time_test').innerHTML);
console.log(time_test)

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
      
      document.getElementById("status").innerHTML =  minutes + "p" + seconds + "s ";
      
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