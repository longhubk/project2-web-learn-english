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

let video = document.getElementById('video_les')

let x =  ''
// VisSense.VisMon.Builder(VisSense(video))
// .on('fullyvisible', function() {
//     myVideo.play();
// })
// .on('hidden', function() {
//     myVideo.pause();
// })
// .build()
// .start();

// $("#video_les").each(function () {
//   var myVideo = document.getElementById(this.id);

//   VisSense.VisMon.Builder(VisSense(myVideo, { fullyvisible: 0.75 }))
//   .on('fullyvisible', function(monitor) {
//     myVideo.play();
//   })
//   .on('hidden', function(monitor) {
//     myVideo.pause();
//   }).build().start();
// });

// let video2 = $('#video_les')$('#main_scroll').on('appear', video2.play)
// .on('disappear', video2.pause);

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
          let id2 = "vi-"+item.start + "-" + item.end
          console.log('scroll to --------->' + id);
          let child = document.getElementById(id)
          let child2 = document.getElementById(id2)
          let other_child = document.getElementsByClassName('sub_vid')
          for(let i = 0; i < other_child.length; i++){
            other_child[i].classList.remove('active_vi')
            other_child[i].classList.remove('active_en')
          }
          child.classList.add('active_en')
          child2.classList.add('active_vi')

          child.scrollIntoView()
          var scrolledY = window.scrollY;
          if(scrolledY){
            window.scroll(0, scrolledY - 500);
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
