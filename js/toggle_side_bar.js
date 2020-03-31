
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

}