$body = $("body");

$(document).on({
    ajaxStart: () => { 
      $body.addClass("loading");
    },
    ajaxStop: () => 
    { 
      $body.removeClass("loading"); 
    }    
});