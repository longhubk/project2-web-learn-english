function scrollFunction() {
    
    if(document.body.classList.contains('ver-nav')){ //_if body have vertical nav can do
      let ver_nav = document.getElementById('ver_nav');
      ver_nav.style.transition = "0s";
    }

  var myButton = document.getElementById("btn_scroll_top");
  var top_before  = document.getElementById("hor-nav").style.height;
  console.log(top_before)

  let ver_nav = document.getElementById('ver_nav');
  let var_nav_2 = document.getElementById("var_nav_2")
  let cal = document.getElementById("cal")
  let qs_right = document.getElementById("qs_right")
  let hor_nav = document.getElementById("hor-nav")

    if(
      typeof(var_nav_2) != 'undefined' && 
      typeof(ver_nav) != 'undefined' && 
      typeof(cal) != 'undefined' && 
      typeof(qs_right) != 'undefined' &&
      typeof(myButton) != 'undefined' 
    ){
      if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 20) {


          hor_nav.style.position = "fixed"
          hor_nav.style.top = 0
          ver_nav.style.top = "32px"
          var_nav_2.style.top = "40px"
          cal.style.marginTop = "30px"
          qs_right.style.height = "240px"
          myButton.style.display = "block";

      } 
      else {
          hor_nav.style.position = "relative"
          ver_nav.style.top = "73px"
          ver_nav_2.style.top = "95px"
          cal.style.marginTop = "10px"
          qs_right.style.height = "200px"
          myButton.style.display = "none";
      }

    }
}
