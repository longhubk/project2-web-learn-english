
// When the user clicks on the button, scroll to the top of the document
function topScroll() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  
  // const c = document.documentElement.scrollTop || document.body.scrollTop;
  // if (c > 0) {
  //   window.requestAnimationFrame(scrollToTop);
  //   window.scrollTo(0, c - c / 8);
  // }
  
}

function  showTab(tab_name, id){
  let tab_btn = document.getElementsByClassName('btn_tab')
  let this_el = document.getElementById(id)
  // console.log("id current : --- " + id)

  for(let i = 0; i < tab_btn.length; i++ ){
    // tab_btn[i].style.backgroundColor = 'grey'
    tab_btn[i].classList.remove('active')
  }
  this_el.classList.add('active')
  // this_el.style.backgroundColor = 'white'

  let tab_el = document.getElementById(tab_name);

  let tab_gr = document.getElementsByClassName('tab')
  for(let i = 0; i < tab_gr.length; i++ ){
    // tab_gr[i].style.display = 'none'
    tab_gr[i].classList.remove('active')
  }

  // tab_el.style.display = 'block'
  tab_el.classList.add('active') 

}