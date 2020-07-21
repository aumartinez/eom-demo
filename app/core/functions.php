<?php
# Helper functions

function randomstr($length) {  
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function snake_case($str) {
  return str_replace("-", "_", $str);
}

function redirect($page) {
  header ("Location: " . SITE_ROOT . $page);  
  exit();
}

?>