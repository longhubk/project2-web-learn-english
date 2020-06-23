$(document).ready(() => {
  $("#btn-search").click(() => {
    let search_key = $('#search').val()
    console.log(search_key)
    if(search_key !== ""){
    	$.ajax({
    		url : "UserPage/getFindFriendForUser",
    		method : "POST",
    		data : {text_search : search_key},
    		success : (data) => {
    			console.log("keyreturn" + data)
      		$("#hidden_search").html(data);
    		}

    })

      // let out = "<p>"+search_key+"</p>"
      // $("#hidden_search").append(out);

      $("#hidden_search").fadeIn(500)
    }

    else if(search_key == ""){
      $("#hidden_search").fadeOut(500)
    }
  })

let id_tmp = ''

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

				let id_qr = "#un_friend-"+id_tmp
				let id_qr2 = "#add_friend-"+id_tmp
				let id_qr3 = "#remove_rq-"+id_tmp
				let id_qr4 = "#accept_rq-"+id_tmp

				$(document).on('click', id_qr3, () =>{	
					console.log('remove_rq ' + id_tmp)
					let friend_un_id = $(id_qr3).attr('id')
					let real_friend_id = friend_un_id.split('-')[1]

					console.log("isdjfiafnisd00000000" + real_friend_id)

					$.ajax({
						url : "UserPage/removeRequest",
						method : 'POST',
						data : {us_want_id : real_friend_id},
						success : (data) =>{
							if(data.trim() == "ok"){
								$(id_qr3).html("removed")
								location.reload()
							}
							else
								$(id_qr3).html("error")

						}

					})

				})

				$(document).on('click', id_qr4, () =>{	
					console.log('accept ' + id_tmp)
					let friend_un_id = $(id_qr4).attr('id')
					let real_friend_id = friend_un_id.split('-')[1]

					console.log("isdjfiafnisd11111111111" + real_friend_id)

					$.ajax({
						url : "UserPage/acceptRequest",
						method : 'POST',
						data : {us_want_id : real_friend_id},
						success : (data) =>{
							if(data.trim() == "ok"){
								$(id_qr4).html("accepted")
								location.href('/UserPage/myFriend')
							}
							else
								$(id_qr4).html("error")

						}

					})

				})

				$(document).on('click', id_qr, () =>{	
					console.log('un_friend ' + id_tmp)
					let friend_un_id = $(id_qr).attr('id')
					let real_friend_id = friend_un_id.split('-')[1]

					console.log("isdjfiafnisdiiiiiiiiiiiiiiiiiiiii" + real_friend_id)

				})


				$(document).on('click', id_qr2, () =>{	

					console.log('add_friend ' + id_tmp)

					let friend_add_id = $(id_qr2).attr('id')
					let real_friend_id = friend_add_id.split('-')[1]

					console.log("isdjfiafnisdiiiiiiiiiiiiiiiiiiiii" + real_friend_id)

					$.ajax({
						url : "UserPage/addUserToMyFriend",
						method : 'POST',
						data : {us_want_id : real_friend_id},
						success : (data) =>{
							if(data.trim() == "ok")
								$(id_qr2).html("sent request")
							else
								$(id_qr2).html("error")

						}

					})

				})

	}






  $('#btn-search div .un_friend').click(() => {
  	let id_unfriend = $('.un_friend').attr('id')
  	console.log("un friend has id: " + id_unfriend)
  })

  $('#btn-search div .add_friend').click(() => {
  	let id_addfriend = $('.add_friend').attr('id')
  	console.log("add friend has id: " + id_addfriend)
  })
  
})