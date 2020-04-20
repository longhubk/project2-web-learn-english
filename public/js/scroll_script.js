function scroll_auto(){
  let element_scroll = document.getElementById('vn-4')
  element_scroll.scrollIntoView()
  
}

function call_Interval(){
  let num_id = 0
  let scope_global =  setInterval(auto_scroll, 2000, num_id)
  function auto_scroll(){
    let that = num_id
    let get_id_li = "vn-" + that
    let get_element_to_scroll = document.getElementById(get_id_li)
    // let scroll_main = document.getElementById('main_scroll')
    // let scroll_height = scroll_main.style.height
    // let scrolledY = scroll_main.scrollY
    // if(scrolledY){
    //   scroll_main.scroll(0, scrolledY - scroll_height)
    // }
    get_element_to_scroll.scrollIntoView()
    if(get_element_to_scroll == null){
      clearInterval(scope_global)
    }
    num_id++
  }
  
}



let btn_scroll = document.getElementById('btn_scroll')
btn_scroll.addEventListener("click", function(){
  scroll_auto()
})
let btn_auto_scroll = document.getElementById('btn_auto_scroll')
btn_auto_scroll.addEventListener("click", function(){
  call_Interval()
})
