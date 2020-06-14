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
            }{
              alert("So Be Careful!")
            }
          })
        }


      }
    })


  }


})