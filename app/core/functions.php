<?php
# Helper functions

function snake_case($str) {
  return str_replace("-", "_", $str);
}

function redirect($page) {
  header ("Location: " . SITE_ROOT . $page);  
  exit();
}

function is_valid_phone($str) {
  $numb = preg_replace("/\D/", "", $str);
  
  if (strlen($numb) == 11) {
    $numb = preg_replace("/^1/", "", $numb);
  }
  
  if (strlen($numb) == 10) {
    return true;
  }
  else {
    return false;
  }  
}

function is_valid_service($str) {
  $arr = array(
  "painting",
  "drywall",
  "sheetrock",
  );
  
  if (in_array($str, $arr)){
    return true;
  }
  else {
    return false;
  }
}

?>