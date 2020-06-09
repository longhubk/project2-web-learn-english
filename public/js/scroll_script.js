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

let x =  ''
let video = document.getElementById('video_les')
video.onplay = function(){
  x = setInterval(
    ()=>{
      let curr_time = video.currentTime
      console.log(curr_time)
      var children = [].slice.call(document.getElementById('main_scroll').getElementsByTagName('*'),0);
      var elements = new Array(children.length);
      var arrayLength = children.length;
      for (var i = 0; i < arrayLength; i++) {
        var name = children[i].getAttribute("id");    
        elements[i] = name;
      }

      console.log(elements)
      let arr_time = []
      for(let i = 0; i < elements.length; i++){
        let curr = elements[i].split('-');
        
        if(curr[0] == 'en' ){
          let obj = {start : curr[1], end : curr[2]}
          arr_time.push(obj)
        }
      }
      console.log(arr_time)

      arr_time.forEach((item) => {
        if(curr_time >= Number(item.start) && curr_time < Number(item.end)){
          let id = "en-"+item.start + "-" + item.end
          console.log('scroll to --------->' + id);
          let child = document.getElementById(id)
          // $('#main_scroll').scrollTo(100)

          var yourHeight = 450;

          // scroll to your element
          // node.scrollIntoView(true);
          child.scrollIntoView()

          // now account for fixed header
          var scrolledY = window.scrollY;

          if(scrolledY){
            window.scroll(0, scrolledY - yourHeight);
          }
          
        }
      })

      

    },1000
  )

}

video.onpause = function(){
  
  clearInterval(x)
}




let btn_scroll = document.getElementById('btn_scroll')

if(btn_scroll != null){
  btn_scroll.addEventListener("click", function(){
    scroll_auto()
  })
}

let btn_auto_scroll = document.getElementById('btn_auto_scroll')

if(btn_auto_scroll != null){
  btn_auto_scroll.addEventListener("click", function(){
    call_Interval()
  })
}
