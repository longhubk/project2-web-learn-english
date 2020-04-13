$(function(){
  $('p').click(function(){
    $(this).hide()
  })
  $('#hide_intro').click(function(){
    $('#head-intro').hide()

  })

  if($('input').val() == ""){
  $('input').blur(function(){
      $(this).css("border", "1px solid red")
      $(this).text()

    })
  }
    
  $("#top_head").mouseenter(function(){
    $('#head-intro').show()
  })

  $("#head-intro").ready(function(){
    $("#head-intro").flash("#d00", 1000)
  })

})
