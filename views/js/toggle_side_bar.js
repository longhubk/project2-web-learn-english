
function toggleSideBar(){
  
  let side_bar = document.getElementById('ver_nav')
  let width_of_side_bar =  side_bar.offsetWidth
  let side_bar_is_open = true
  side_bar.style.transition = "0.3s"
  if(width_of_side_bar > 1){
    side_bar_is_open = false
  }else{
    side_bar_is_open = true
  }
  if(side_bar_is_open){
    side_bar.style.width = "230px"
  }else{
    side_bar.style.width = "0"
  }
  //!this important for
  //? thi is command
  /**
   * ?this is best comment
   * !this is warning for you
   * * this is alway show in comand
   * TODO: This is some thing you have to do now 
   * //some this is predicate here
   * 
   */
  
}