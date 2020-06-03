$(document).ready(() => {
  let tut_id = Number($("#tut_id").html())
  let arr_les_id = []
  $.ajax({
    url : "./HomeAdmin/getAllLessonIdOfTut",
    method: 'POST',
    data : {tut_id: tut_id},
    success : (data) => {
      arr_les_id = dat
    }
  })
  let str = "#delete_lesson-"
})