$(document).ready(() =>{
  let num_res_find = 0;
  $('#btn_search_friend').click(() => {
    let value = $('#input_find_friend').val()
    let user_name = $('#sm_avt').attr('title')
    console.log('username :' + user_name)
    console.log('value' + value);
    $.ajax({
      method : "POST",
      url : "UserPage/getFriendById",
      data: {'us_name': user_name, 'friend_find': value },
      success : (res) =>{
        // console.log(JSON.stringify(res))
        json_data = JSON.parse(res)

        let otherUser = json_data.success
        console.log("other:" +otherUser)
        num_res_find = otherUser.length
        let list = $('#list_user')
        for(let i = 0; i < otherUser.length; i++){
          list.append("<div>"+
            "<p>"+otherUser[i][0]+"</p>"+
            "<button id='add_friend-"+i+"' value='"+otherUser[i][1]+"'>add friend</button>"+

          "</div>")
        }
      }

    })
  })

    // let user_id = $('#user_send_id').html()
    // console.log('user id = ' + user_id)
    // for(let i = 0; i < num_res_find; i++){
    //   let id = '#add_friend-'+i;
    //   let friend_id = $(id).attr('value')
    //   console.log('friend id = ' + friend_id)
      
    //   $(id).click(() =>{
    //     $.ajax({
    //       method : "POST",
    //       url : "UserPage/sendAddFriend",
    //       data : {"user_id": $user_id, "friend_ep_id" : friend_id}

    //     })
    //   })
    // }


})