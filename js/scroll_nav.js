function scrollFunction(){
  if(document.body.scrollTop > 60 || document.documentElement.scrollTop >60){
    document.getElementById("hor-nav").style.top = 0
    document.getElementById("ver_nav").style.top = "36px"
    document.getElementById("ver_nav_2").style.top = "37px"
    document.getElementById("cal").style.marginTop = "40px"
    document.getElementById("qs_right").style.height = "240px"

  }else{
    document.getElementById("hor-nav").style.top = "60px"
    document.getElementById("ver_nav").style.top = "96px"
    document.getElementById("ver_nav_2").style.top = "100px"
    document.getElementById("cal").style.marginTop = "10px"
    document.getElementById("qs_right").style.height = "200px"
  }
}