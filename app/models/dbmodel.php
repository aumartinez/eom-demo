<?php

class DbModel {

  protected $rows = array();  
  protected $conx;
  protected $new_id;
  
  private $sql;
  private $columns = array();  

  public function __construct() {
    $this->sql = "";
    $this->columns = array();
    $this->values = array();
  }  
  
  # Test if DBNAME exists
  public function test_db() {
    $this->conx = new mysqli(DBHOST, DBUSER, DBPASS);
    if ($this->conx->connect_errno) {
      error_log("Database test failed: " . $this->conx->connect_error );
      echo "Failed to connect to MySQL: " . $this->conx->connect_error;      
      exit();
    }
    
    return $this->conx->select_db(DBNAME);
  }  
  
  # Open DB link
  protected function open_link() {  
    $this->conx = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if ($this->conx->connect_errno) {
      error_log("Connection failed" . $this->conx->connect_error);
      $_SESSION["error"][] = "Failed to connect to MySQL: " . $this->conx->connect_error;
      exit();
    }
        
    return $this->conx;
  }
    
  # Close DB link
  protected function close_link() {
    $this->conx->close();
  }
  
  # Submit SQL query for INSERT, UPDATE or DELETE
  protected function set_query($sql) {
    $this->open_link();
    $result = $this->conx->query($sql);
    
    if (!$result) {
      error_log("Query failed: " . $sql);
      $_SESSION["error"][] = "Query error: " . $this->conx->error;
    }
    
    $this->new_id = $this->conx->insert_id;    
    $this->close_link();
  }
  
  protected function set_multyquery($sql) {
    $this->open_link();
    $result = $this->conx->multi_query($sql);
    
    if (!$result) {
      error_log("Query failed: " . $sql);
      $_SESSION["error"][] = "Query error: " . $this->conx->error;      
    }
    
    $this->close_link();
  }
    
  # Submit SELECT SQL query
  protected function get_query($sql) {
    $this->rows = array();
    $this->open_link();
    $result = $this->conx->query($sql);     
    
    if (!$result) {
      error_log("Query failed: " . $sql);
      $_SESSION["error"][] = "Query error: " . $this->conx->error;
      return false;
    }
    
    while ($this->rows[] = $result->fetch_assoc());    
    $result->free();
    $this->close_link();
    
    array_pop($this->rows);
    return $this->rows;
  }
  
  # Submit SELECT SQL query - get row count if matches found
  protected function get_rows($sql) {
    $this->open_link();
    $result = $this->conx->query($sql);
    
    if (!$result) {
      error_log("Query failed: " . $sql);
      $_SESSION["error"][] = "Query error: " . $this->conx->error;
      return false;
    }
    
    $rows = $result->num_rows;    
    return $rows;    
  }

  # Considering to upgrade to prepared statements  
  protected function insert($table){
    $this->sql .= "INSERT INTO {$table} (";
    return $this;
  }
  
  protected function columns($columns) {
    $this->columns = $columns;
    $str = is_array($columns)? implode(", ", $columns) : $columns;
    
    $this->sql .= $str;
    return $this;
  }
  
  protected function values($types, $values) {   
    $str = "";
    if (is_array($this->columns)){
      foreach ($this->columns as $val) {
        $str .= "?, ";
      }
    }
    else {
      $str .= "?";
    }
    
    $str = rtrim($str, ", ");    
    $this->sql .= ") VALUES ({$str})";
    $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);    
    
    $stmt = $mysqli->prepare($this->sql);
    
    if (!$stmt) {
      $_SESSION["error"][] = "Couldn't prepare query";
    }
    
    $values = is_array($values)? implode(", ", $values) : $values;
            
    $stmt->bind_param($types, $values);
    $stmt->execute();
    $stmt->close();
    
    return $this;
  }
  
}

?>