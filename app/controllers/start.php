<?php

class Start extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
            
    # Any models required to interact with this controller should be loaded here    
    $this->load_model("StartModel");
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
    
    # CSRF hash
    if (empty($_SESSION["token"]) || !isset($_SESSION["token"])) {
        $_SESSION["token"] = bin2hex(random_bytes(32));
    }
    
    # Initial state
    $locales = array(
    "ERROR_ACTIVE" => "",
    "SUCCESS_ACTIVE" => "",
    "ERROR" => "",
    "SUCCESS" => "",
    "CSRF" => $_SESSION["token"],
    );
    
    $this->output->add_localearray($locales);
    
    # Throw error if any is found
    if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0){
                             
      $err_mess = "\n";
      $err_mess .= "Errors found!";
      $err_mess .= "<br />\n";
      
      foreach ($_SESSION["error"] as $error) {
        $err_mess .= $error . "<br />\n";
      }
      
      $locales = array(
      "ERROR_ACTIVE" => "active",
      "ERROR" => $err_mess
      );
      
      $this->output->add_localearray($locales);
      unset($_SESSION["error"]);
    }
    
    # If success message is received
    if (isset($_SESSION["success"]) && count($_SESSION["success"]) > 0) {
      $arr = array(
      "SUCCESS_ACTIVE" => "active",
      "SUCCESS" => $_SESSION["success"][0],
      );
      
      $this->output->add_localearray($arr);
      unset($_SESSION["success"]);
    }
    
    $this->get_model("PageModel")->page_title="Index";
    $this->build_page("start");
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
