window.onload = addListeners;

  function addListeners(){
    document.getElementsByClassName('btn').item(0).addEventListener("click", subEvent,false)
    document.getElementsByName('textfield').item(0).addEventListener("keypress", textEvent, false);
    document.getElementsByName('email').item(0).addEventListener("keypress", emailEvent, false);
    document.getElementsByName('password').item(0).addEventListener("click", passwordEvent, false);
}

  function textEvent(e){
    var text =  document.getElementsByName('text').item(0);
    text.style.background = "#9ae59a";
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

      var text =  document.getElementsByName('text').item(0);
      var vtext =  text.value;
        if(vtext == ""){
          text.style.background = "#ff6666";
      }

}
