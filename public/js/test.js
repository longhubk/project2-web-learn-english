var countDownDate = new Date();
var countDownDate2 = new Date(countDownDate)

let time_test = Number(document.getElementById('time_test').innerHTML);
console.log(time_test)

countDownDate2.setMinutes(countDownDate.getMinutes() + time_test);

countDownDate3 = countDownDate2.getTime()

var x = setInterval(function() {

  var now = new Date().getTime();
  var distance = countDownDate3 - now;
    
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById("status").innerHTML =  minutes + "p" + seconds + "s ";
    
    if (distance < 0) {
    clearInterval(x);
    document.getElementById("status").innerHTML = "EXPIRED";
    $(document).ready(() =>{
      $('#trigger_test').trigger('click')
    })

    }
}, 1000);