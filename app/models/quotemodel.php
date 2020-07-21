<?php

class QuoteModel extends DbModel {
  public $sanitized = array();
  
  public function __construct(){
    $this->sanitized = array();
  }
  
  public function csrf_check($route) {
    if (isset($_POST["csrf"]) && !empty($_POST["csrf"])) {
      if (!isset($_SESSION["token"]) || !hash_equals($_SESSION["token"], $_POST["csrf"])){
        $_SESSION["error"][] = "Session expired try again";
        $mess = array("error" => "Session expired try again");
        
        echo json_encode($mess);
      }
      else{
        return true;
      }
    }
    else {
      $_SESSION["error"][] = "Session expired try again";
      $mess = array("error" => "Session expired try again");
      
      echo json_encode($mess);
    }
    
    unset($_SESSION["token"]);    
    $this->error_check($route);
  }
  
  public function sanitize_str($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
      
    $str = $this->open_link()->real_escape_string($str);    
    $this->close_link();
    
    return $str;
  }
  
  public function sanitize_post($route) {
    $this->sanitized = array();      
    
    foreach ($_POST as $key => $value) {
      $value = trim($value);      
      $value = stripslashes($value);
      $value = htmlspecialchars($value);
      
      $this->sanitized[$key] = $this->open_link()->real_escape_string($value);      
    }
    $this->close_link();
    $this->error_check($route);
    
    return $this->sanitized;
  }
  
  # Error check method
  protected function error_check($page) {
    if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0) {
      error_log("Error validating form", 0);
      redirect($page);
    }
  }
  
}

?>