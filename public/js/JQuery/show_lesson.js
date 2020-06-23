$(document).ready(() => {

  let number_toggle = $('#all_tut_size').html()
  if($('#all_test_size').length){
    number_toggle = $('#all_test_size').html()
  }

  for(let i = 0; i < number_toggle; i++){
    let id_click            = '#show_lesson-'+i;
    let id_toggle           = '#toggle_lesson-'+i;
    let id_toggle_edit      = '#edit_tut-'+i;
    let id_click_add_les    = '#show_add_lesson-'+i;
    let id_toggle_add_les   = '#toggle_add_lesson-'+i;
    let id_toggle_tut_edit  = '#toggle_edit-'+i;
    let id_click_edit_test  = "#edit_test-"+i;
    let id_toggle_edit_test = "#toggle_edit_test-"+i;

    $(id_toggle_edit_test).hide()
    $(id_toggle_tut_edit).hide()

    $(id_click_edit_test).click(()=> {

      if($(id_toggle_edit_test).is(':visible'))
        $(id_toggle_edit_test).fadeOut(500)
      else
        $(id_toggle_edit_test).fadeIn(600)
      for(let j = 0; j < number_toggle; j++){
        let id_click_edit_test_else = '#edit_test-'+j;
        let id_toggle_edit_test_else = '#toggle_edit_test-'+j;

        if(id_click_edit_test_else != id_click_edit_test){
          $(id_toggle_edit_test_else).css('display', 'none')
        }
      }

    })


    $(id_click).click(() =>{
      if($(id_toggle).is(':visible'))
        $(id_toggle).fadeOut(500)
      else
        $(id_toggle).fadeIn(600)
      for(let j = 0; j < number_toggle; j++){
        let id_click_else = '#show_lesson-'+j;
        let id_toggle_else = '#toggle_lesson-'+j;

        if(id_click_else != id_click){
          $(id_toggle_else).css('display', 'none')
        }
      }
    })

    $(id_toggle_edit).click(() =>{
      if($(id_toggle_tut_edit).is(':visible'))
        $(id_toggle_tut_edit).fadeOut(500)
      else
        $(id_toggle_tut_edit).fadeIn(600)

        // $(id_toggle_tut_edit).slideToggle()

      for(let j = 0; j < number_toggle; j++){
        let id_toggle_edit_else_click = "#edit_tut-"+j
        let id_toggle_edit_else = '#toggle_edit-'+j
        let id_toggle_add_les_else = '#toggle_add_lesson-'+j;
        $(id_toggle_add_les_else).css('display', 'none')

        if(id_toggle_edit_else_click != id_toggle_edit){
          $(id_toggle_edit_else).css('display','none')
        }
      }
    })

    $(id_click_add_les).click(() =>{
      // $(id_toggle_add_les).slideToggle()
      if($(id_toggle_add_les).is(':visible'))
        $(id_toggle_add_les).fadeOut(600)
      else
        $(id_toggle_add_les).fadeIn(500)
      for(let j = 0; j < number_toggle; j++){
        let id_click_add_les_else = '#show_add_lesson-'+j;
        let id_toggle_add_les_else = '#toggle_add_lesson-'+j;
        let id_toggle_else = '#toggle_lesson-'+j;
        let id_toggle_edit_else = '#toggle_edit-'+i
        $(id_toggle_edit_else).css('display','none')
        
        if(id_click_add_les_else != id_click_add_les){
          $(id_toggle_add_les_else).css('display', 'none')
          $(id_toggle_else).css('display', 'none')
        }
      }
    })
  }

  

})
