$("#slide_show > div:gt(0)").hide();

setInterval(function() {
  $('#slide_show > div:first')
    .hide(1000)
    .next()
    .show(1000)
    .end()
    .appendTo('#slide_show');
}, 3000);