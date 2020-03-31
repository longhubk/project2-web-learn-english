
 var player
 function onYouTubeIframeAPIReady() {
   player = new YT.Player('player', {
     events: {
       'onReady': onPlayerReady,
       'onStageChange': onPlayerStateChange
     }
   })
 }

 function onPlayerReady(e) {
   e.target.playVideo()
 }
 function onPlayerStateChange(e){
   alert("state change")
 }

