<?php

class EmailModel extends DbModel {
  
  private $email;
  private $subject;
  
  public function __construct () {
    $this->email = "";
    $this->subject = "";
  }
    
  # Each method will request the model to present the local resource
  public function send_email($subject, $email, $emailbody, $temp) { 
    $this->email = $email;
            
    $to = $this->email;
    $from = SENDER_EMAIL;
    $this->subject = $subject;
    $txt = quoted_printable_encode($emailbody);
    
    $headers = array(
    "MIME-Version: 1.0",
    "Content-Transfer-Encoding: quoted-printable",
    "Content-type:text/html;charset=UTF-8",
    "From: General Remodeling <" . $from . ">",
    "Reply-To: " . $from
    );
    
    $headers = implode("\r\n", $headers);
    $send = mail($to, $this->subject, $txt, $headers);
  }  
  
  public function get_emailtemp($temp = "default") {
    $html = "";
    if (file_exists(HTML . DS . "email" . DS . $temp . ".html")) {
      $html .= file_get_contents(HTML . DS . "email" . DS . $temp . ".html");
      $html .= "\n";
    }
    
    return $html;
  }
  
}

?>