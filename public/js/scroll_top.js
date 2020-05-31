
// When the user clicks on the button, scroll to the top of the document
function topScroll() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  
  // const c = document.documentElement.scrollTop || document.body.scrollTop;
  // if (c > 0) {
  //   window.requestAnimationFrame(scrollToTop);
  //   window.scrollTo(0, c - c / 8);
  // }
  
}