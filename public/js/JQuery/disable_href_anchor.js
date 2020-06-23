$(document).ready(() => {

  $('.link_anchor a').each(
    function() {
        href = $(this).attr('href');
        console.log(href)
        if (href) {
            if (href.match(/#/i)) {
                new_href = window.location + href;
                $(this).attr('href', new_href);
            }
        }
    }
  );

})