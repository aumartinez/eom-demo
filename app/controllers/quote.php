<?php

class Quote extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
            
    # Any models required to interact with this controller should be loaded here    
    $this->load_model("QuoteModel");
  }
  
  # Each method will request the model to present the local resource
  
  # Landing page method
  public function index() {
    # 404 page
    $this->get_model("PageModel")->page_title="404 Error";
    $this->build_page("not-found");
  }
  
  public function process() {
    $_SESSION["error"] = array();
    $route = "/demos/eom-demo/";
    
    $this->get_model("QuoteModel")->csrf_check($route);
    
    echo "passed";
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