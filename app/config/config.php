<?php

# Database link credentials
define ("DBNAME", "eom_demo");
define ("DBUSER", "root");
define ("DBPASS", "");
define ("DBHOST", "localhost");

# App name
define ("WEB_TITLE", "General Remodeling");

# App main folder name
define ("PATH", "eom-demo"); # App container folder

# PATH to media files and site root constants
define ("SITE_ROOT", "/demos/" . PATH);
define ("MEDIA", SITE_ROOT . "/" . "public");
define ("HTML", "public" . DS . "html");
define ("THEME", "default-theme");
define ("UPLOAD", "public/uploads/");

# Default states
define ("DEFAULT_CONTROLLER", "start");
define ("DEFAULT_METHOD", "index");
define ("NOT_FOUND", "not_found");

# Email address to send welcome email
define ("SENDER_EMAIL", "no-reply@accedo-gps.000webhostapp.com");

# Startup Locales
define ("LOCALES", 
        array(
          "SITE_ROOT" => SITE_ROOT,
          "MEDIA" => MEDIA,
          "THEME" => THEME,
        ));
?>