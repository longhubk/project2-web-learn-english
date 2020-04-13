$(document).ready(function(){
  $("#usernameid").keyup(function(){
    var user = $(this).val();

    $.post("./Ajax/CheckUsername", {un:user} ,function(data){
      $("#messageid").html(data);
    })


  })
})