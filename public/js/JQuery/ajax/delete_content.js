$(document).ready(() => {

  // console.log("hello")
  if($('#les_up_id').length){
    let les_id = Number($('#les_up_id').html())
    let ct_arr = []
    console.log('let_up_id ' + les_id)
    $.ajax({
      url : "AdminPage/getContentIdToDelete",
      method : 'POST',
      data : {les_id : les_id},
      success : (data) => {
        let res = data.trim(); 
        ct_arr = res.split(',')
        // console.log(res)
        // console.log("ct_arr: "+ ct_arr)

        for(let i = 0; i < ct_arr.length; i++){
          let ct_id = '#delete_ct_'+les_id+"-"+ct_arr[i]

          $(ct_id).click(() => {
            console.log(ct_id + "clicked")
            if(confirm("Are you sure to delete this content?")){
              $.ajax({
                url : "AdminPage/getDeleteContent",
                method : 'POST',
                data : {content_id : ct_arr[i], les_id: les_id},
                success : (data2) => {
                  if(data2.trim() == 'ok'){
                    alert("This content has been deleted!")
                    location.reload()
                  }else
                    alert("Deleting process error!")
                }

              })
            }else{
              alert("So Be Careful!")
            }
          })
        }


      }
    })


  }

  if($('#max_id_ct_basic').length){
    let max_id_ct_bs = Number($('#max_id_ct_basic').html())

    let str_id = '#del_ct_bs-'
    for(let i = 0; i <= max_id_ct_bs; i++){
      let id_ct_bs = str_id + i
      $(id_ct_bs).click(() => {
        console.log(id_ct_bs + "clicked")
        if(confirm("Are you sure to delete this content?")){
          $.ajax({
            url : "AdminPage/getDeleteContentBasic",
            method : 'POST',
            data : {content_id : i},
            success : (data2) => {
              if(data2.trim() == 'ok'){
                alert("This content has been deleted!")
                location.reload()
              }else
                alert("Deleting process error!")
              // $('#debug_div').html(data2.trim())
            }

          })
        }else{
          alert("So Be Careful!")
        }
      })

    }

  }
  if($('#max_id_ct_doc').length){
    let max_id_ct_doc = Number($('#max_id_ct_doc').html())

    let str_id = '#del_ct_doc-'
    for(let i = 0; i <= max_id_ct_doc; i++){
      let id_ct_bs = str_id + i
      $(id_ct_bs).click(() => {
        console.log(id_ct_bs + "clicked")
        if(confirm("Are you sure to delete this content?")){
          $.ajax({
            url : "AdminPage/getDeleteContentDoc",
            method : 'POST',
            data : {content_id : i},
            success : (data2) => {
              if(data2.trim() == 'ok'){
                alert("This content has been deleted!")
                location.reload()
              }else
                alert("Deleting process error!")
            }

          })
        }else{
          alert("So Be Careful!")
        }
      })

    }

  }


})