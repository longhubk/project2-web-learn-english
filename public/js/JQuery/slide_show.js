$("#slide_show > div:gt(0)").hide();

setInterval(function() {
  $('#slide_show > div:first')
      .hide()
      .next()
      .show()
      .end()
      .appendTo('#slide_show');
}, 7000);