function scrollFunction() {
    
    if(document.body.classList.contains('ver-nav')){ //_if body have vertical nav can do
      let ver_nav = document.getElementById('ver_nav');
      ver_nav.style.transition = "0s";
    }

  
  var top_before  = document.getElementById("hor-nav").style.height;
  console.log(top_before)

  if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 20) {
    let hor_nav = document.getElementById("hor-nav")
    hor_nav.style.position = "fixed"
    hor_nav.style.top = 0
    document.getElementById("ver_nav").style.top = "32px"
    document.getElementById("ver_nav_2").style.top = "40px"
    document.getElementById("cal").style.marginTop = "30px"
    document.getElementById("qs_right").style.height = "240px"

    // alert("1")
  } else {
    let hor_nav = document.getElementById("hor-nav")
    hor_nav.style.position = "relative"
    // hor_nav.style.top = "43px"
    document.getElementById("ver_nav").style.top = "73px"
    document.getElementById("ver_nav_2").style.top = "95px"
    document.getElementById("cal").style.marginTop = "10px"
    document.getElementById("qs_right").style.height = "200px"
    // alert("2")
  }
}
