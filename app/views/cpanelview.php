<?php

class CPanelView extends PageView {
    
  # Initialize keywords dictionary
  public function __construct(){
    parent::__construct();
  }
  
  public function user_info() {
    $html = "";
    
    $html .= '
    <div id="navbar-sidebar" class="sidebar-nav sidebar collapse  navbar-collapse bg-secondary">
        <div class="user-profile">
          <div class="row flex-center">
            <div class="col-12">
              <div class="user-pic">
                <img src="{$MEDIA$}/uploads/{$USER_PIC$}" alt="User picture" class="img-responsive" />
              </div>
            </div>
            
            <div class="col-12">
              <div class="user-info">
                <p class="color-white">
                  {$USER_NAME$}
                </p>
              </div>
            </div>
          </div>          
        </div>
        
        {$SIDEBAR_NAVBAR$}
        
        <nav class="navbar bottom-nav bg-cta">
          <ul class="navbar-nav">
            <li>
              <a href="{$SITE_ROOT$}/cpanel/logout">
                <span><i class="fas fa-sign-out-alt"></i></span> 
                <span class="nav-text">Logout</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    ';
    
    $html .= "\r\n";
    
    return $this->replace_localizations($html);
  }
    
  public function navbar() {
    $html = "";
    
    $html.= '
        <nav class="sidebar-nav navbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{$SITE_ROOT$}/cpanel/" >
                <span class="icon" title="Home"><i class="fas fa-home"></i></span>
                <span class="nav-text">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$SITE_ROOT$}/cpanel/profile" >
                <span class="icon" title="Profile"><i class="far fa-user"></i></span>
                <span class="nav-text">My Profile</span>
              </a>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link" href="{$SITE_ROOT$}/cpanel/properties" >
                <span class="icon" title="My Properties"><i class="fas fa-house-user"></i></span> 
                <span class="nav-text">My Properties</span>
              </a>
            </li>
            -->
            <!-- Future enhancement -->
            <li class="nav-item">
              <a class="nav-link" href="{$SITE_ROOT$}/cpanel/notifications" title="Notifications">
                <span class="icon"><i class="far fa-bell"></i></span> <span class="nav-text">Notificactions</span>
                <span class="alert">{$NOTIFICATIONS$}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$SITE_ROOT$}/cpanel/settings" title="Settings">
                <span class="icon"><i class="fas fa-cog"></i></span> <span class="nav-text">Settings</span>
              </a>
            </li>
          </ul>
        </nav>
    ';
    
    $html .= "\r\n";
    
    return $this->replace_localizations($html);
  }
  
  public function utility_list($utility_list) {
    $html = "";
        
    if (count($utility_list) > 0) {
      foreach ($utility_list as $rows) {
        foreach ($rows as $value) {
          $html .= '
            <li class="nav-item">
              <a class="nav-link" href="{$SITE_ROOT$}/cpanel/utility/'. strtolower($value) . '?id={$PROPERTY_CODE$}" title="' . $value .'">' . $value . '</a>
            </li>
            ';  
            
          $html .= "\r\n";
        }
      }  
    }
    
    return $this->replace_localizations($html);
  }
  
  public function connect_all($utility_list) {
    $html = "";
    
    if (count($utility_list) > 0) {
      foreach ($utility_list as $rows) {
        foreach ($rows as $value) {
          $html .= '
            <li class="form-check">
              <input id="id_'. strtolower($value) .'" name="id_'. strtolower($value) .'" type="checkbox" class="form-check-input" value="'. strtolower($value) .'" checked data-toggle="active" data-target=".util_'.strtolower($value).'"/>
              <label class="text-left" for="id_'. strtolower($value) .'">
                '. $value . '
              </label>
            </li>
            ';  
            
          $html .= "\r\n";
        }
      }  
    }
    
    return $this->replace_localizations($html);
  }
  
  public function connect_all_providers($providers) {
    $html = "";
    
    if (count($providers) > 0) {
      for ($i = 0; $i < count($providers); $i++) {
        $utility_type = strtolower($providers[$i]["utility_type"]);
        $utility_type = str_replace("/\s+/", "",$utility_type);
        
        $html .= '
      <div class="utility-wrapper col-md-12 active util_'.$utility_type.'" data-label="id_'. $utility_type .'">
        <div class="row">
        
          <div class="col-md-4">              
            <label for="prov_'. $utility_type .'">
              '. $providers[$i]["utility_type"] .'
              <span class="help" data-toggle="tooltip" data-placement="top" title="as it appears on the bill"><i class="fas fa-question-circle"></i></span><span class="required">*</span>
            </label>              
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input id="prov_'. $utility_type .'" name="prov_'. $utility_type .'" type="text" class="form-control" value="'. $providers[$i]["provider"] .'"/>
              <div class="alert error">
                This is a required field
              </div>
            </div>              
          </div>
          
          <div class="col-md-4">              
            <label for="acc_'. $utility_type .'">
              Account number
              <span class="help" data-toggle="tooltip" data-placement="top" title="as it appears on the bill"><i class="fas fa-question-circle"></i></span><span class="required">*</span>
            </label>              
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input id="acc_'. $utility_type .'" name="acc_'. $utility_type .'" type="text" class="form-control" value="'. $providers[$i]["account"] .'"/>
              <div class="alert error">
                This is a required field
              </div>
            </div>              
          </div>
        
        </div>
      </div>
        ';
        
        $html .= "\r\n";
      }
      
    }
    
    return $this->replace_localizations($html);
  }
  
  public function address($prop) {
    $html = "";
    
    $html .= '
      <span>{$ADDRESS_1$}</span><br />
      ';
      
    if (!$prop || $prop->address_2 !== "") {
      $html .= '<span>{$ADDRESS_2$}</span><br />'; 
    }
    
    $html .= '
      <span>{$CITY$}, {$STATE$}</span><br />
      <span>{$POSTALCODE$}</span>
    ';
    
    return $this->replace_localizations($html);
                  
  }
  
  public function month_expenses($util) {
    $html = "";
    $n = count((array)$util);
        
    if ($n > 0) {
      for ($i = 0; $i < $n; $i++) {
        $html .= '
        <div class="col-6 col-md-4 col-lg-2 xs-sm-bottom-margin">
          <p class="bg-lite month-holder">
            <span class="icon"></span>
            <span class="month-data">
              <span class="utility-type">'. $util->{$i}["utility_type"] .'</span>
              <span class="bill"> U$ '. $util->{$i}["total_bill"] .'</span>
            </span>
            <span class="due-date hidden">'. $util->{$i}["due_date"] .'</span>
            <span class="paid hidden"></span>
          </p>
        </div>
        ';
      }
    }
    
    $html .= "\r\n";
    
    return $html;
  }
  
  public function bill_history($bill) {
    $html = "";
    
    $html .= '
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="hidden-cell-xs">
            Item
          </th>
          <th scope="col">
            Utility type
          </th>
          <th scope="col" class="hidden-cell-xs">
            From
          </th>
          <th scope="col" class="hidden-cell-xs">
            To
          </th>
          <th scope="col">
            Due date
          </th>
          <th scope="col">
            Total bill
          </th>
          <th scope="col">
            Edit
          </th>
        </tr>
      </thead>
      <tbody>
    ';
    
    $n = count((array)$bill);
    
    if ($n > 0) {
      for ($i = 0; $i < $n; $i++) {
        $bill_date = strtotime($bill->{$i}["due_date"]);        
        $bill_date = date("m-d-y", $bill_date);
        
        $start_date = strtotime($bill->{$i}["start_date"]);
        $start_date = date("m-d-y", $start_date);
        
        $end_date = strtotime($bill->{$i}["end_date"]);
        $end_date = date("m-d-y", $end_date);
        
        $html .= '
        <tr>
          <th scope="row" class="hidden-cell-xs">
            '. ($i + 1) .'
          </th>
          <td>
            '. $bill->{$i}["utility_type"] .'
          </td>
          <td class="hidden-cell-xs">
            '. $start_date .'
          </td>
          <td class="hidden-cell-xs">
            '. $end_date .'
          </td>
          <td class="bill-date">
            '. $bill_date .'
          </td>
          <td class="bill-amount">
            <span class="hidden-inline-xs">U$</span> '. $bill->{$i}["total_bill"] .'
          </td>
          <td>
            <a href="'. SITE_ROOT .'/cpanel/edit/utility?id='. $bill->{$i}["id"] .'" title="Edit this utility bill"><span><i class="fas fa-edit"></i></span></a>
          </td>
        </tr>
        ';
      }
    }
    
    $html .= '
    </tbody>
    </table>
    ';
    
    $html .= "\r\n";
    
    return $html;
  }
  
  public function utility_consumption() {
    $html = "";
    
    $html .= '
    <div class="col-md-12 utility-item bg-white sm-top-margin">
     <div class="row">
       <div class="col-md-6">
        <h4 class="no-margin">
         Current month consumption
        </h4>
       </div>
       <div class="col-md-6">
        <p class="no-margin">
          {$CONSUMPTION$} {$MES_UNIT$}
        </p>
       </div>
     </div>
    </div>
    ';
    
    return $html;
  }
  
  public function utility_meter() {
    $html = "";
    
    $html .= '
    <div class="col-md-12 utility-item bg-white sm-top-margin">
     <div class="row">
       <div class="col-md-6">
        <h4 class="no-margin">
         Meter Number
        </h4>
       </div>
       <div class="col-md-6">
        <p class="no-margin">
          {$METER_NUMBER$}
        </p>
       </div>
     </div>
    </div>
    ';
    
    return $html;
  }
  
  public function consumption_chart() {
    $html = "";
    
    $html .= '
    <div class="bg-white">
      <div class="sm-padding">
        <h2>
          <span>Utility Consumption</span> ({$MES_UNIT$})
        </h2>
      </div>    
      <div class="inner chart-wrapper card bg-white">
        <canvas id="consumption-chart-canvas" class="active" width="400" height="400">
          Your browser does not support canvas to display the charts
        </canvas>
      </div>
    </div>
    ';
    
    return $html;
  }
  
}

?>
