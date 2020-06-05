$(document).ready(() => {

  let number_toggle = $('#all_tut_size').html()
  if($('#all_test_size').length){
    // alert("hello")
    number_toggle = $('#all_test_size').html()
  }

  // alert(number_toggle)
  for(let i = 0; i < number_toggle; i++){
    let id_click = '#show_lesson-'+i;
    let id_toggle = '#toggle_lesson-'+i;
    let id_click_add_les = '#show_add_lesson-'+i;
    let id_toggle_add_les = '#toggle_add_lesson-'+i;

    $(id_click).click(() =>{
      // alert("you want to look lesson")
      $(id_toggle).toggle()
      for(let j = 0; j < number_toggle; j++){
        let id_click_else = '#show_lesson-'+j;
        let id_toggle_else = '#toggle_lesson-'+j;

        if(id_click_else != id_click){
          $(id_toggle_else).css('display', 'none')
        }
      }
    })

    $(id_click_add_les).click(() =>{
      // alert("you want to look lesson")
      $(id_toggle_add_les).toggle()
      // $(id_toggle).toggle()
      for(let j = 0; j < number_toggle; j++){
        let id_click_add_les_else = '#show_add_lesson-'+j;
        let id_toggle_add_les_else = '#toggle_add_lesson-'+j;
        let id_toggle_else = '#toggle_lesson-'+j;
        
        if(id_click_add_les_else != id_click_add_les){
          $(id_toggle_add_les_else).css('display', 'none')
          $(id_toggle_else).css('display', 'none')
        }
      }
    })
  }
  

})
