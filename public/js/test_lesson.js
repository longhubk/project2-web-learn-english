$(document).ready(() => {
  $('#btn_submit_quiz').click(() => {
    let arr_quiz = []
    let name_les = $('#name_les').html()
    let num_quiz = $('.input_quiz').length /4
    console.log(num_quiz)
    for(let i = 0; i < num_quiz; i++)
      arr_quiz[i] = new Array(4)

    $('.input_quiz').each(function(){
      let id_quiz_ans = $(this).prop("id")
      let arr_id = id_quiz_ans.split("-")
      let ans_num = arr_id[1];
      let ans_qs_id = arr_id[2];
      if($(this).prop("checked") == true)
        arr_quiz[ans_qs_id][ans_num] = 1
      else 
        arr_quiz[ans_qs_id][ans_num] = 0

    });

    $.ajax({ 
      url : "TutorialPage/checkQuiz",
      method : "POST",
      data: {arr_quiz : arr_quiz, name_les : name_les},
      success: (data) => {
        let res = data.trim()
        let out = "Kết quả của bạn là: " + res + "/" + num_quiz
        $('#res_quiz').html(out)
      }

    })
    console.log(arr_quiz)
    console.log(name_les)

    // console.log("test lesson submit")
  })
  

})