$(document).ready(() =>{
  // let num_user = $('#number_user').html()
  // console.log(num_user)
  // let str_us_id = $('#us_id_ad').html()
  // let arr_user = str_us_id.split(',', str_us_id)
  let arr_user = '0'


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