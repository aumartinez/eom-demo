<?php

class Quote extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
            
    # Any models required to interact with this controller should be loaded here    
    $this->load_model("QuoteModel");    
    $this->load_model("PageModel");
    $this->load_model("EmailModel");
    
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
  
  public function process() {
    $_SESSION["error"] = array();
    $route = "/#quote-title";
    
    $this->get_model("QuoteModel")->csrf_check($route);
    $this->get_model("QuoteModel")->required($route);
    $this->get_model("QuoteModel")->sanitize_post($route);
    $this->get_model("QuoteModel")->validate_form($route);
    $arr = $this->get_model("QuoteModel")->sanitized;
    
    $_SESSION["success"][] = "Your quote has been emailed, check your inbox and SPAM folder";
    
    $area = $arr["area"];
    $unit = $this->get_model("QuoteModel")->get_service($arr["services"]);
    $total = $area * $unit["service_value"];
    
    $locales = array(
    "CLIENT_NAME" => $arr["name"],
    "EMAIL_ADDRESS" => $arr["email"],
    "PHONE" => $arr["phone"],
    "SERVICE" => ucfirst($arr["services"]),
    "AREA" => $arr["area"],
    "UNIT_VALUE" => $unit["service_value"],
    "TOTAL" => $total,
    "SUBJECT" => $arr["subject"],
    "MESSAGE" => $arr["message"],
    );
    
    $this->output->add_localearray($locales);
    
    $str = "";    
    if (is_https()) {
      $str .= "https://";
    }
    else {
      $str .= "http://";
    }
    
    $str .= $_SERVER["SERVER_NAME"];
    $this->output->add_locale("SERVER", $str);
    
    # Send email to client
    $subject = "Your free quote is ready";
    $email = $arr["email"];
    $emailbody = $this->get_emailbody("quote");
    $this->get_model("EmailModel")->send_email($subject, $email, $emailbody, "quote");
    
    redirect($route);
  }
  
  public function ajax() {
    $_SESSION["error"] = array();
    $route = "/#quote-title";
    
    $this->get_model("QuoteModel")->csrf_check($route);
    $this->get_model("QuoteModel")->required($route);
    $this->get_model("QuoteModel")->sanitize_post($route);
    $this->get_model("QuoteModel")->validate_form($route);
    $arr = $this->get_model("QuoteModel")->sanitized;
       
    $area = $arr["area"];
    $unit = $this->get_model("QuoteModel")->get_service($arr["services"]);
    $total = $area * $unit["service_value"];
    
    $locales = array(
    "CLIENT_NAME" => $arr["name"],
    "EMAIL_ADDRESS" => $arr["email"],
    "PHONE" => $arr["phone"],
    "SERVICE" => ucfirst($arr["services"]),
    "AREA" => $arr["area"],
    "UNIT_VALUE" => $unit["service_value"],
    "TOTAL" => $total,
    "SUBJECT" => $arr["subject"],
    "MESSAGE" => $arr["message"],
    );
    
    $this->output->add_localearray($locales);
    
    $str = "";    
    if (is_https()) {
      $str .= "https://";
    }
    else {
      $str .= "http://";
    }
    
    $str .= $_SERVER["SERVER_NAME"];
    $this->output->add_locale("SERVER", $str);
    
    # Send email to client
    $subject = "Your free quote is ready";
    $email = $arr["email"];
    $emailbody = $this->get_emailbody("quote");
    $this->get_model("EmailModel")->send_email($subject, $email, $emailbody, "quote");
    
    $mess = array(
    "success" => "Your quote has been emailed, check your inbox and SPAM folder", 
    );
    echo json_encode($mess);
    exit();
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
  
  protected function get_emailbody($emailtemp) {    
    $html_src = $this->get_model("EmailModel")->get_emailtemp($emailtemp);    
    $html = $this->output->replace_localizations($html_src);
    
    return $html;
  }
  
}

?>