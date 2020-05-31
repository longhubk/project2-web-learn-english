$(document).ready(() =>{
  let number_cont_basic = $('#num_cont_basic').html()
  // alert(number_cont_basic)
  let audioId = '#aud';
  let imageId = '#img';
  for(let i = 0; i < number_cont_basic; i++){
    for(let j = 1; j <= 3; j++){
      let audioId1 = audioId + "_" + j + "_" + i;
      let imageId1 = imageId + "_" + j + "_" + i;
      $(imageId1).click( ()=>{
        // alert(audioId1 + " and " + imageId1)
        // alert($(audioId1).paused)
        // if($(audioId1).paused == false) 
        //   $(audioId1).pause();
        // else
          $(audioId1).play();

      })
    }
  }
})