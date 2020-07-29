# eom-demo
 EOM DEMO

## Preview URL

URL:
https://accedo-gps.000webhostapp.com/demo/eom-demo/

## Webservice implementation demo

How to create a webservice using PHP and connecting the service using AJAX and JQuery

1. First create the DB table structure (MySQL or anything similar)

```SQL
CREATE TABLE IF NOT EXISTS eom_services (
  id INT NOT NULL AUTO_INCREMENT,
  services VARCHAR(120) NOT NULL,
  service_value VARCHAR(10) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;
```

2. Fill in some sample data

```SQL
INSERT INTO eom_services (id, services, service_value, created_at, updated_at) VALUES
(1, 'Painting', '20', '2020-07-21 00:30:07', '2020-07-21 00:30:07'),
(2, 'Drywall', '45', '2020-07-21 00:30:07', '2020-07-21 00:30:07'),
(3, 'Sheetrock', '33.05', '2020-07-21 00:30:07', '2020-07-21 00:30:07');
```

3. Create HTML, CSS, site template, this one uses Bootstrap 4 as the frontend framework

4. Add form

5. Create PHP webservice script, using an MVC basic framework for PHP, a controller called WS is added

```php
<?php

class WS extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
    
    header('Content-Type: application/json');
    
    # Any models required to interact with this controller should be loaded here    
    $this->load_model("PageModel");
    $this->load_model("WSModel");
    
    # Instantiate custom view output
    $this->output = new PageView();    
  }
  
  # Each method will request the model to present the local resource
  
  # Landing page method
  public function index() {
    # 404 page
    $this->get_model("PageModel")->page_title="404 Error";
    $this->build_page("not-found");
  }
  
  public function get_value() {
    $val = $_POST["services"];
    $val = $this->get_model("WSModel")->sanitize_str($val);
    
    $result = $this->get_model("WSModel")->get_value($val);
    
    echo json_encode($result);
  }
  
  public function get_values() {
    $values = $this->get_model("WSModel")->get_values();
    echo json_encode($values);
  }
      
  # Not found handler
  public function not_found() {    
    # 404 page
    $this->get_model("PageModel")->page_title="404 Error";
    $this->build_page("not-found");
  }
  
  # Controller/Model/View link
  protected function build_page($page_name) {    
    $html_src = $this->get_model("PageModel")->get_page($page_name);    
    $html = $this->output->replace_localizations($html_src);
    
    $this->get_view()->render($html);
  }
  
}

?>
```

This controller start/instantiates a PageModel class that presents/returns a "not found" page if incorrect URL or request is submitted.

Webservice class connects to the DB using a WSModel class

```php
<?php

class WSModel extends DbModel {
  
  public function get_values() {
    $sql = "SELECT service_value
          FROM eom_services";
    
    $res = $this->get_query($sql);
      
    return $res;
  }
  
  public function get_value($str) {
    $sql = "SELECT service_value
            FROM eom_services
            WHERE services = '{$str}'";
            
    $res = $this->get_query($sql);
    
    return $res;
  }
  
  public function sanitize_str($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
      
    $str = $this->open_link()->real_escape_string($str);    
    $this->close_link();
    
    return $str;
  }
  
}

?>
```

This model inherits base methods from the DBModel class, which are the ones used to open the connection and submit queries to the DB. This model also has the sanitization methods to clear any undesired input from the user.

When the method "get-value" is called submitting the query with the proper POST package, a query is submitted to the DB and returned as a JSON string. Submitting an incorrect or empty POST package, results in the return of an empty JSON.

6. Connect form to the WS using JS (JQuery)

JQuery comes handy when an AJAX call is needed and since it is required to use Bootstrap, then it is used as the preferred library for this purpose.

```JS
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
});
```

The above piece of code/function is called when the "services" form control changes (it is a dropdown selection control) and it submits the request to the above WebService, retrieve the JSON string and put it to one of the form controls. The purpose of the form is to provide a quick compute of a service value, while the user adds for example an estimated area to work with one of the provides services in the options list.
