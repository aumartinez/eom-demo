"use strict";

$(document).ready(function(){
  
  $("#quote-form").submit(function(e){
    $(".loader").addClass("active");
    let errors = validateForm();
    
    if (errors.length == 0) {
      ajaxSubmit();
    }
    else {
      e.preventDefault();
      removeErrors();
      displayErrors(errors);
      $(".loader").removeClass("active");
    }
    
    function validateForm() {
      let err = [];
      let req = [];
      
      req = [
      "#name",
      "#email",
      "#phone",
      "#services",
      "#area",
      "#subject",
      "#message"
      ];
      
      for (let i = 0; i < req.length; i++) {
        if ($(req[i]).val().trim().length == 0) {
          err.push(req[i]);
        }
      }
      
      //Validate email    
      let email = $("#email").val();
      let regExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      let testEmail = regExp.exec(email);
      
      if (!testEmail) {
         $("#email").next().text("Add a valid email address");
         err.push("#email");
      }
      
      //Validate phone
      if ($("#phone").val().trim().length > 0) {
        let phoneNumb = $("#phone").val();
        
        //Remove any non valid character
        phoneNumb = phoneNumb.replace(/[^0-9]/g, "");
        
        if (phoneNumb.length != 10) {
          err.push("#phone");
        }
      }
      
      return err;
      
    }
    
  });
  
  function displayErrors(err) {
    for (let i = 0; i < err.length; i++) {
      $(err[i]).next().addClass("active");
    }
    
    $("#error").addClass("active");
    $("#error").text("Errors found!");
    
    $(".error.active").click(function(){
      let elem = event.currentTarget;
      $(elem).removeClass("active");
    });
  }
  
  function removeErrors() {
    $(".error.active").removeClass("active");
  }  
  
  function ajaxSubmit(){
    
  }
});