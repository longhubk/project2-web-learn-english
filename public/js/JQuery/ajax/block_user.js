$(document).ready(() =>{
  // let num_user = $('#number_user').html()
  // console.log(num_user)
  // let str_us_id = $('#us_id_ad').html()
  // let arr_user = str_us_id.split(',', str_us_id)
  let arr_user = '0'

  
function fetchUserId(){
  $.ajax({
    url : 'UserPage/getUserListId',
    method : 'POST',
    success : (data) => {
    	let res = data.trim()
			let arr_id = res.split(',')

			for(let i = 0; i < arr_id.length; i++){
				id_tmp = arr_id[i]
				nextLoadUser()
			}
    }
  })
}
	
	fetchUserId()

	function nextLoadUser(){
		console.log("next to sdnfsfaif frined===" +id_tmp)

				let id_qr1 = "#un_block-"+id_tmp
				let id_qr2 = "#down_permission-"+id_tmp
				let id_qr3 = "#block-"+id_tmp
				let id_qr4 = "#up_permission-"+id_tmp
				let id_qr5 = "#delete_user-"+id_tmp
				let id_qr6 = "#info-"+id_tmp

				$(document).on('click', id_qr3, () =>{	
					let user_id = $(id_qr3).attr('id')
					let real_user_id = user_id.split('-')[1]
					$.ajax({
            url : "AdminPage/getBlockUser/",
						method : 'POST',
            data : {'user_id' : real_user_id},
						success : (data) =>{
							if(data.trim() == "ok") location.reload()
						}
					})
        })

				$(document).on('click', id_qr6, () =>{	
					let user_id = $(id_qr6).attr('id')
					let real_user_id = user_id.split('-')[1]
					$.ajax({
            url : "AdminPage/getViewInfoUser/",
						method : 'POST',
            data : {'user_id' : real_user_id},
						success : (data) =>{
              // if(data.trim() == "ok"){

              $('#info_user').html(data)
              $('#info_user_contain').slideDown(500)


              // location.reload()
						}
          })
        })

				$(document).on('click', '#info_user_contain', () =>{	
          $('#info_user_contain').slideUp(300)
        })

				$(document).on('click', id_qr1, () =>{	
					let user_id = $(id_qr1).attr('id')
					let real_user_id = user_id.split('-')[1]
					$.ajax({
            url : "AdminPage/getUnBlockUser/",
						method : 'POST',
            data : {'user_id' : real_user_id},
						success : (data) =>{
							if(data.trim() == "ok") location.reload()
						}
					})
        })

				$(document).on('click', id_qr2, () =>{	
					let user_id = $(id_qr2).attr('id')
					let real_user_id = user_id.split('-')[1]
					$.ajax({
            url : "AdminPage/getDownPermission/",
						method : 'POST',
            data : {'user_id' : real_user_id},
						success : (data) =>{
							if(data.trim() == "ok") location.reload()
						}
					})
        })

				$(document).on('click', id_qr4, () =>{	
					let user_id = $(id_qr4).attr('id')
					let real_user_id = user_id.split('-')[1]
					$.ajax({
            url : "AdminPage/getUpPermission/",
						method : 'POST',
            data : {'user_id' : real_user_id},
						success : (data) =>{
							if(data.trim() == "ok") location.reload()
						}
					})
        })

				$(document).on('click', id_qr5, () =>{	
					let user_id = $(id_qr5).attr('id')
          let real_user_id = user_id.split('-')[1]

          if(confirm('Are sure to delete this user!!!')){
            $.ajax({
              url : "AdminPage/getDeleteUser/",
              method : 'POST',
              data : {'user_id' : real_user_id},
              success : (data) =>{
                if(data.trim() == "ok") location.reload()
              }
            })
          }else
            alert('So Be Careful!')

        })




  }


  for(let i = 0; i < arr_user.length; i++){
    let id_block = '#block-' + arr_user[i];

    $(id_block).click(() =>{
      console.log('you click to '+ arr_user[i])
        $.confirm({
          title: 'Confirm!',
          content: 'Are you sure you want to block ?', // not getting the result
          buttons: {
            confirm: function () {
              $.alert('confirm');
              
              $.ajax({
                method: "POST",
                url : "AdminPage/getBlockUser/",
                data : {'user_id' : arr_user[i]},

                success: (res) =>{
                  let json_data = JSON.parse(res)
                  if(json_data.success == 'ok')
                    alert("You have block out this user");
                  else
                    alert("Block user fail !");
                }
              })

            },
            cancel: function () {
              $.alert('<span style="font-size: 23px">Upgrade Cancelled!</span>');
            }
          }
        });
    })
  }
})