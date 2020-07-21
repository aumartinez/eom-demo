"use strict";

$(document).ready(function(){
  $("#services").change(function(){
    let url = "/demo/eom-demo/ws/get-value";
    let services = $("#services").val().trim();
        
    $.ajax({
      data:{"services": services},
      type: "POST",
      dataType: "json",
      url: url,
      beforeSend: function(){
        $(".ajax-loader").addClass("active");
      }
    })
    .done(function(data, textStatus, jqXHR){
      $(".ajax-loader").removeClass("active");
      let mult = "";
      
      try{
        let val = Number(data[0].service_value).toFixed(2);
        $("#service-value").val(val);
        
        let area = $("#area").val();
        let value = $("#service-value").val();
        mult = (area * value).toFixed(2);  
      }
      catch(e){
        $("#service-value").val("");
        mult = "";
      }
      
      $("#cost").val(mult);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
      $("#error").addClass("active");
      $("#error").text("Server error");
    });
    
  });
  
  $("#area").change(function(){
    let area = $("#area").val();
    let value = $("#service-value").val();
    let mult = (area * value).toFixed(2);
    
    $("#cost").val(mult);
  });
  
  $("#quote-form").submit(function(e){
    $(".loader").addClass("active");
    let errors = validateForm();
    
    if (errors.length == 0) {
      e.preventDefault();
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
          $("#phone").next().text("Phone number should be 10 digits");
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
  
  function ajaxSubmit() {
    let data = {
      "csrf": $("#csrf").val().trim(),
      "name": $("#name").val().trim(),
      "email": $("#email").val().trim(),
      "phone": $("#phone").val().trim(),
      "services": $("#services").val().trim(),
      "area": $("#area").val().trim(),
      "subject": $("#subject").val().trim(),
      "message": $("#message").val().trim(),
    };
    
    let url = "/demo/eom-demo/quote/ajax";
    
    $.ajax({
      data: data,
      type: "POST",
      dataType: "json",
      url: url,
      beforeSend: function(){
        $("#error").removeClass("active");
        $(".loader").addClass("active");
      },
    })
    .done(function(data, textStatus, jqXHR){
      $(".loader").removeClass("active");
      
      $("#success").addClass("active");
      $("#success").text(data.success);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
      $("#error").addClass("active");
      $("#error").text("Server error");
    });
  }
    
});
