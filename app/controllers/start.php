<?php

class Start extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
            
    # Any models required to interact with this controller should be loaded here    
    $this->load_model("StartModel");
    $this->load_model("FormsModel");
    $this->load_model("PageModel");
    
    # Instantiate custom view output
    $this->output = new PageView();
    
    $path = $_SERVER["DOCUMENT_ROOT"] . DS . SITE_ROOT . DS . "public" . DS;
    
    $css = $path . "css" . DS ."default-theme.css";    
    $css_version = filemtime($css);
    $this->output->add_locale("CSS_VERSION", $css_version);
    
    $js = $path . "js" . DS ."main.js";    
    $js_version = filemtime($js);
    $this->output->add_locale("JS_VERSION", $js_version);
  }
  
  # Each method will request the model to present the local resource
  
  # Landing page method
  public function index() {
    $this->build_page("start");
  }
      
  # Not found handler
  public function not_found() {    
    # 404 page
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