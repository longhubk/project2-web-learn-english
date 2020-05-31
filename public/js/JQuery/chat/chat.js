
fetchFriend()

setInterval(() => {
	updateLastActive()
	fetchFriend()
},5000)

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
	let content_text = '<div id="user_dialog_" '+ friend_id>+'" class="user_dialog" title="You have chat with' + friend_name + '">';
	
	content_text += '<div style="height : 400px; border: 1px solid black; overflow-y : scroll; margin-bottom : 24px; padding : 16px; " class="chat_history" data-toFriendId="'+ friend_id + '" id="chat_history_'+ friend_id+'" >';
	
	content_text += '</div>';
	content_text += '<div class="form-group">';
	content_text += '<textarea name="chat_message_'+friend_id+'" id="chat_message_'+friend_id+'" class="form-control"></textarea>';

	content_text += '</div><div class="form-group" align="right">';
	content_text += '<button type="button" name="send_chat" id="'+friend_id+'" class="send_chat">Send</button></div></div>';
	
	$('#friend_model_detail').html(content_text);
	
}

	$(document).on('click', '.start_chat', () =>{
		let friend_id = $(this).data('toFriendId');
		let friend_name= $(this).data('toFriendName');
		create_chat_dialog(friend_id, friend_name);
		
		$('#user_dialog_'+friend_id).dialog({
			autoOpen: false,
			width: 400
		})
		$('#user_dialog_'+friend_id).dialog('open');
		
	})

