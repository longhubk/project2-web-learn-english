
var secs = 10;
timer = setInterval(function () {
    var element = document.getElementById("status");
    element.innerHTML = "<h2>You have <b>"+secs+"</b> seconds to answer the questions</h2>";
    if(secs < 1){
        clearInterval(timer);
        document.getElementById('submit_test_form').submit();
    }
    secs--;
}, 1000)