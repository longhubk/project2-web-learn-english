

function scrollFunction(){
  let ver_nav = document.getElementById('ver_nav');
  ver_nav.style.transition = "0s";

  if(document.body.scrollTop > 60 || document.documentElement.scrollTop >60){
    let hor_nav = document.getElementById("hor-nav")
    hor_nav.style.position = "fixed"
    hor_nav.style.top = 0
    document.getElementById("ver_nav").style.top = "35px"
    document.getElementById("ver_nav_2").style.top = "40px"
    document.getElementById("cal").style.marginTop = "30px"
    document.getElementById("qs_right").style.height = "240px"

  }else{
    let hor_nav = document.getElementById("hor-nav")
    hor_nav.style.position = "absolute"
    hor_nav.style.top = "44px"
    document.getElementById("ver_nav").style.top = "78px"
    document.getElementById("ver_nav_2").style.top = "95px"
    document.getElementById("cal").style.marginTop = "10px"
    document.getElementById("qs_right").style.height = "200px"
  }
}