<?php

class WSModel extends DbModel {
    
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
