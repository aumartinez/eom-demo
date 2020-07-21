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
