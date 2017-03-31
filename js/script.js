window.onload = addListeners;

  function addListeners(){
    document.getElementsByClassName('btn').item(0).addEventListener("click", subEvent,false)
    document.getElementsByName('username').item(0).addEventListener("keypress", textEvent, false);
    document.getElementsByName('email').item(0).addEventListener("keypress", emailEvent, false);
    document.getElementsByName('password').item(0).addEventListener("click", passwordEvent, false);
}

  function userEvent(e){
    var user =  document.getElementsByName('username').item(0);
    user.style.background = "#9ae59a";
}

  function emailEvent(e){
    var email =  document.getElementsByName('email').item(0);
    email.style.background = "#9ae59a";
}

  function passwordEvent(e){
    var password =  document.getElementsByName('password').item(0);
    password.style.borderColor = "#9ae59a";
}

  function passwordVerifyEvent(e){
    var passwordVerify =  document.getElementsByName('passwordVerify').item(0);
    passwordVerify.style.background = "#9ae59a";
}

  function subEvent (e){

    var email =  document.getElementsByName('email').item(0);
    var vemail =  email.value;
      if (vemail == ""){
        email.style.background = "#ff6666";
        e.preventDefault();


          var username =  document.getElementsByName('username').item(0);
          var vusername =  email.value;
          if (vusername == ""){
              username.style.background = "#ff6666";
              e.preventDefault();
          }

    var password = document.getElementsByName('password').item(0);
    var vpassword = password.value;
      if(vpassword == false){
        e.preventDefault();
      }
    var password1 = document.getElementsByName('password1').item(0);
    var vpassword1 = password1.value;
      if(vpassword1 == false){
        e.preventDefault();
      }


}
