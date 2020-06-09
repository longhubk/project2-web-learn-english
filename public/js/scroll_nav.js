function scrollFunction() {
    
    if(document.body.classList.contains('ver-nav')){ //_if body have vertical nav can do
      let ver_nav = document.getElementById('ver_nav');
      ver_nav.style.transition = "0s";
    }

  var myButton = document.getElementById("btn_scroll_top");
  var top_before  = document.getElementById("hor-nav").style.height;
  // console.log(top_before)

  let ver_nav   = document.getElementById('ver_nav');
  let ver_nav_2 = document.getElementById("ver_nav_2")
  let cal       = document.getElementById("cal")
  let qs_right  = document.getElementById("qs_right")
  let hor_nav   = document.getElementById("hor-nav")
  let search_box   = document.getElementById("hidden_search")

  // console.log("typeof hor_nav: " + hor_nav))
  // console.log("typeof ver_nav: " + ver_nav))
  // console.log("typeof ver_nav2: " + ver_nav_2))
  // console.log("typeof cal: " + cal))
  // console.log("typeof qs_right: " + qs_right))
  // console.log("typeof my button: " + myButton))
    
    
      if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 20) {

          if(search_box != null ){
            search_box.style.top = "40px" 
          }

          if(hor_nav != null){
            hor_nav.style.position = "fixed"
            hor_nav.style.top = 0
          }
          if(ver_nav != null){
            ver_nav.style.top = "32px"
          }
          if(ver_nav_2 != null){
            ver_nav_2.style.top = "40px"
          }
          if(cal != null){
            cal.style.marginTop = "30px"
          }
          if(qs_right != null){
            qs_right.style.height = "240px"
          }
          if(myButton != null){
            myButton.style.display = "block";
          }

      } 
      else {

          if(search_box != null ){
            search_box.style.top = "80px" 
          }

          if(hor_nav != null){
            hor_nav.style.position = "relative"
            hor_nav.style.top = 0

          }
          if(ver_nav != null){
            ver_nav.style.top = "73px"
          }
          if(ver_nav_2 != null){
            ver_nav_2.style.top = "95px"
          }
          if(cal != null){
            cal.style.marginTop = "10px"
          }
          if(qs_right != null){
            qs_right.style.height = "200px"
          }
          if(myButton != null){
            myButton.style.display = "none";
          }

      }

    
}
