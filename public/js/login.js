function openLogin(){
  document.getElementById("log-1").style.display = "block"
}
function closeLogin(){
  document.getElementById("log-1").style.display = "none"
}

//  window.onclick = function(event){
//    var login_var = document.getElementById("log-1")
//    if(event.target == login_var){
//      login_var.style.display = "none" 
//    }
//  }

  $(window).click(function(e){
    if(e.target.id == "log-1")
      window.location.href = ("./Home")
  })



   //   let check_forget = document.getElementById("forget_pw")
   //   let check_new_acc = document.getElementById("sign_up_new_acc")

   //   let remember_me = document.getElementById("remember_me")
   //   remember_me.innerHTML = "Remember me"
   //   if(typeof(check_forget) != 'undefined' && check_forget != null){
      

   //   else{
   //    let re_create_forget_pw = document.createElement('a')
   //    let re_create_new_acc = document.createElement('a')
   //    let span_forget = document.getElementById("span_forget")
   //    let span_new_acc = document.getElementById("span_new_acc")
   //    re_create_forget_pw.innerHTML = "Forget password"
   //    re_create_forget_pw.setAttribute("href" , "#")
   //    re_create_forget_pw.setAttribute("id", "forget_pw")
   //    re_create_new_acc.innerHTML = "Sign up new account"
   //    re_create_new_acc.setAttribute("href" , "#")
   //    re_create_new_acc.setAttribute("id", "sign_up_new_acc")
   //    span_forget.appendChild(re_create_forget_pw)
   //    span_new_acc.appendChild(re_create_new_acc)
   //   }

  

   //   let removeEmail_Label = document.getElementById('email_label')
   //   let removeEmail_Input = document.getElementById("email_input")
   //   let removePass_Again_Label = document.getElementById('pass_again_label')
   //   let removePass_Again_Input = document.getElementById("pass_again_input")
   //   if(typeof(removeEmail_Input) != 'undefined' && removeEmail_Input != null)
   //      removeEmail_Input.remove()
   //   if(typeof(removeEmail_Label) != 'undefined' && removeEmail_Label != null)
   //      removeEmail_Label.remove()
   //   if(typeof(removePass_Again_Label) != 'undefined' && removePass_Again_Label != null)
   //      removePass_Again_Label.remove()
   //   if(typeof(removePass_Again_Input) != 'undefined' && removePass_Again_Input != null)
   //      removePass_Again_Input.remove()
   // }




// function openSignUp(){
//     let password = document.getElementById("password_id")
//     let nameInput = document.getElementById('name_input')
//     let forget_pw = document.getElementById('forget_pw')
//     let signUp_new_acc = document.getElementById('sign_up_new_acc')
//     let submit_btn = document.getElementById("submit_btn")
//     let remember_me = document.getElementById("remember_me")
//     remember_me.innerHTML = "I agree your License and Agreement"

//     submit_btn.setAttribute("value" , "Create")
//     forget_pw.remove()
//     signUp_new_acc.remove()


//     let email_insert_label = createElement('label', 'Email', "login-label", "email_label")
//     let email_insert_input = createInput("email","text", "Enter email", "email_input")

//     let pw_again_insert_label = createElement('label', 'Password again', "login-label", "pass_again_label")
//     let pw_again_insert_input = createInput("password_again","password", "Enter password again", "pass_again_input")
//     nameInput.after(email_insert_label, email_insert_input)
//     password.after(pw_again_insert_label, pw_again_insert_input)
    
//  }

//  function createElement(name_div, text_inner, name_class, name_id){
//   let element = document.createElement(name_div)
//   let text = document.createTextNode(text_inner)
//   element.appendChild(text)
//   element.setAttribute("class", name_class)
//   element.setAttribute("id", name_id)
//   return element
//  }
//  function createInput(name, type, placeholder, id){
//     let input = document.createElement('input')
//     input.setAttribute("name", name)
//     input.setAttribute("type", type)
//     input.setAttribute("placeholder", placeholder)
//     input.setAttribute("id", id)
//     return input
//  }