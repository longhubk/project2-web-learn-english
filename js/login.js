function openLogin(){
  document.getElementById("log-1").style.display = "block"
 }
 function closeLogin(){
  document.getElementById("log-1").style.display = "none"
 }

 window.onclick = function(event){
   var login_var = document.getElementById("log-1")
   if(event.target == login_var)
     login_var.style.display = "none" 
 }