
fetchFriend()

setInterval(() => {
	updateLastActive()
	fetchFriend()
	update_chat_history_realtime()
},3000)



function fetchFriend(){
  $.ajax({
    url : 'UserPage/getFriendList',
    method : 'POST',
    success : (data) => {
      $('#friend_detail').html(data)
    }
  })
}

function updateLastActive(){
  $.ajax({
    url : 'UserPage/updateMyActive',
    method : 'POST',
    success : (data) => {
      
    }
  })
}

function create_chat_dialog(friend_id, friend_name){
	let content_text = '';
	
	content_text += '<div class="chat_history" data-toFriendId="'+ friend_id + '" id="chat_history_'+ friend_id+'" >';
	
	content_text += fetch_user_history(friend_id)
	content_text += '</div>';
	content_text += '<div class="chat_control">';
	content_text += '<textarea name="chat_message_'+friend_id+'" id="chat_message_'+friend_id+'" class="chat_area"></textarea>';

	content_text += '<div><img name="send_chat" id="'+friend_id+'" class="chat_send icon-25" src="public/icon/send_icon.png"></div></div>';
	
	$('#friend_model_detail').html(content_text);
	
}
	// $(document).ready(() => {

	// 	jQuery('tr.switch button.start_chat').click(function(evt) {
	// 		evt.preventDefault();
	// 		console.log('hello')
	// 		var idFriend = jQuery(this).data("tofriendid");
	// 		var nameFriend = jQuery(this).data("tofriendname");
	// 		create_chat_dialog(idFriend, nameFriend);
	// 		$('#user_dialog_'+idFriend).toggle();
	// 	});

	// })


	$(document).on('click', '.start_chat', () =>{
		$('#friend_model_detail').toggle()
		// console.log('hello')
		var idFriend = $('.start_chat').data("tofriendid");
		// var id_btn = "#chat_to-" + idFriend;
		// $(id_btn).html('Close Chat')
		console.log('friend_id: '+ idFriend)
		var nameFriend = $('.start_chat').data("tofriendname");
		console.log('friend_name: '+ nameFriend)
		create_chat_dialog(idFriend, nameFriend);
		$('#user_dialog_'+idFriend).toggle();
	})

	


	$(document).on('click', '.chat_send', (evt) =>{
		evt.preventDefault();

		let friend_id = $('.chat_send').attr('id')
		let chat_message = $('#chat_message_'+friend_id).val()
		$.ajax({
			url : 'UserPage/insertChatMessage',
			method : 'POST',
			data : {friend_id:friend_id, chat_message:chat_message},
			success : (data) => {
				$('#chat_message_'+friend_id).val('') //__set message box empty
				$('#chat_history_'+friend_id).html(data)

			}
		})

	})

	function fetch_user_history(friend_id){
		$.ajax({
			url : 'UserPage/getHistoryMessage',
			method : 'POST',
			data : {friend_id:friend_id},
			success : (data) =>{
				$('#chat_history_'+friend_id).html(data)
			}

		})
	}

	var old_num_mes = 0;
	function fetch_num_mes_two_people(friend_id){
		console.log("old: "+  old_num_mes)
		$.ajax({
			url : 'UserPage/getCountMesTwoPeople',
			method : 'POST',
			data : {friend_id:friend_id},
			success : (data) =>{
					if(data != old_num_mes){
						old_num_mes = data;
						auto_scroll_message()
					}
			}

		})
		
	}

	function update_chat_history_realtime(){
		$('.chat_history').each(() => {
			var idFriend = $('.chat_history').data("tofriendid");
			fetch_user_history(idFriend)
			fetch_num_mes_two_people(idFriend)
		})
	}

	function auto_scroll_message(){
		$('.chat_history').scrollTop($('.chat_history').prop("scrollHeight"));
	}
