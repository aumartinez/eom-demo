
-- First run Forms

-- Add your property table

CREATE TABLE IF NOT EXISTS uj_properties (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  property_code VARCHAR(20),
  address_1 VARCHAR(255),
  address_2 VARCHAR(255),
  city VARCHAR(120),
  u_state VARCHAR(100),
  postalcode VARCHAR(10),
  country VARCHAR(120),
  picture VARCHAR(120),
  nickname VARCHAR(50),
  property_type VARCHAR(20),
  year_build INT(4),
  bedrooms VARCHAR(20),
  baths VARCHAR(20),
  u_default VARCHAR(10),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

-- Add you profile information

CREATE TABLE IF NOT EXISTS uj_profiles (
  id INT NOT NULL AUTO_INCREMENT,
  cust_id VARCHAR(10),
  email VARCHAR(120) NOT NULL,
  profile_pic VARCHAR(120),
  firstname VARCHAR(100),
  lastname VARCHAR(100),
  companyname VARCHAR(100),
  phone_number BIGINT(10),
  pref_contact VARCHAR(20),
  account_type VARCHAR(50),
  signed_as VARCHAR(50),
  active INT(1),
  first_run INT(1),
  signed_with VARCHAR(20),
  extra_verification INT(1),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_users (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  password VARCHAR(255),
  salt VARCHAR(100),
  user_key VARCHAR(255),
  signed_with VARCHAR(20),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

-- Unsubscribe

CREATE TABLE IF NOT EXISTS uj_unsubscribe (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120),
  created_at DATETIME,
  PRIMARY KEY (id)  
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_emailfail_log (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  email_type VARCHAR(50),
  failed_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_emailsuccess_log (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,  
  email_type VARCHAR(50),
  send_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_settings (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  months INT (2) DEFAULT 6,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_notifications (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  notification VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_utilities (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  property_code VARCHAR(20),
  utility_type VARCHAR(50),
  utility_id VARCHAR(10),
  u_connect VARCHAR(10),
  u_connect_date DATE,
  u_disconnect VARCHAR(10),
  u_disconnect_date DATE,
  provider VARCHAR(50),
  address_1 VARCHAR(255),
  address_2 VARCHAR(255),
  city VARCHAR(120),
  u_state VARCHAR(100),
  postalcode VARCHAR(10),
  country VARCHAR(120),
  account VARCHAR(50),
  meter VARCHAR(50),
  move_date DATE,
  exp_date DATE,
  u_usage VARCHAR(20),
  start_date DATE,
  end_date DATE,
  due_date DATE,
  curr_charges VARCHAR(20),
  prev_balance VARCHAR(20),
  past_due FLOAT,
  late_fee VARCHAR(20),
  total_bill VARCHAR(20),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_connect (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  property_code VARCHAR(20),
  utilities_toconnect VARCHAR(255),  
  address_1 VARCHAR(255),
  address_2 VARCHAR(255),
  city VARCHAR(120),
  u_state VARCHAR(100),
  postalcode VARCHAR(10),
  country VARCHAR(120),
  providers_info VARCHAR(255),
  loa VARCHAR(255),
  start_date DATE,
  stop_date DATE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;


CREATE TABLE IF NOT EXISTS uj_connect_all (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  submitted VARCHAR(10) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;


CREATE TABLE IF NOT EXISTS uj_disconnect (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  property_code VARCHAR(20),
  utilities_todisconnect VARCHAR(255),  
  address_1 VARCHAR(255),
  address_2 VARCHAR(255),
  city VARCHAR(120),
  u_state VARCHAR(100),
  postalcode VARCHAR(10),
  country VARCHAR(120),
  providers_info VARCHAR(255),
  loa VARCHAR(255),
  stop_date DATE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;


CREATE TABLE IF NOT EXISTS uj_disconnect_all (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  submitted VARCHAR(10) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

-- Reset password

CREATE TABLE IF NOT EXISTS uj_reset_pass (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,  
  email VARCHAR(120) NOT NULL,
  user_id VARCHAR(50) NOT NULL,
  pass_key VARCHAR(255) NOT NULL,
  status INT NOT NULL,
  created_date DATETIME NOT NULL,
  updated_date DATETIME NOT NULL  
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;


-- Sign up Forms tables

-- New move/in Forms

CREATE TABLE IF NOT EXISTS uj_e_comp_movein (
  id INT NOT NULL AUTO_INCREMENT,
  e_comp_email VARCHAR(120) NOT NULL,  
  e_comp_companyname VARCHAR(255),
  e_comp_firstname VARCHAR(100),
  e_comp_lastname VARCHAR(100),
  e_comp_phone BIGINT(10),  
  e_comp_movein_address1 VARCHAR(255),
  e_comp_movein_address2 VARCHAR(255),
  e_comp_movein_city VARCHAR(120),
  e_comp_movein_state VARCHAR(100),  
  e_comp_movein_zip VARCHAR(10),
  e_comp_movein_date DATE,
  e_comp_moveout_address1 VARCHAR(255),
  e_comp_moveout_address2 VARCHAR(255),
  e_comp_moveout_city VARCHAR(120),
  e_comp_moveout_state VARCHAR(100),
  e_comp_moveout_zip VARCHAR(10),
  e_comp_moveout_date DATE,
  e_comp_proptype VARCHAR(20),
  e_comp_terms VARCHAR(10),
  e_comp_uploaded VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_e_ind_movein (
  id INT NOT NULL AUTO_INCREMENT,
  e_ind_email VARCHAR(120) NOT NULL,
  e_ind_firstname VARCHAR(100),
  e_ind_lastname VARCHAR(100),
  e_ind_phone BIGINT(10),
  e_ind_month VARCHAR(20),
  e_ind_day INT(2),
  e_ind_year INT(4),
  e_ind_movein_address1 VARCHAR(255),
  e_ind_movein_address2 VARCHAR(255),
  e_ind_movein_city VARCHAR(120),
  e_ind_movein_state VARCHAR(100),  
  e_ind_movein_zip VARCHAR(10),
  e_ind_movein_date DATE,
  e_ind_moveout_address1 VARCHAR(255),
  e_ind_moveout_address2 VARCHAR(255),
  e_ind_moveout_city VARCHAR(120),
  e_ind_moveout_state VARCHAR(100),
  e_ind_moveout_zip VARCHAR(10),
  e_ind_moveout_date DATE,
  e_ind_proptype VARCHAR(20),
  e_ind_terms VARCHAR(10),
  e_ind_uploaded VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

-- Move in upload excel file table

CREATE TABLE IF NOT EXISTS uj_e_movein_upload (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(120) NOT NULL,
  doc VARCHAR(255),
  service_address VARCHAR(255),
  city VARCHAR(50),
  u_state VARCHAR(50),
  zip_code BIGINT(10),
  u_connect VARCHAR(50),
  start_date DATE,
  end_date DATE,
  electricity VARCHAR(10),
  water VARCHAR(10),
  sewer VARCHAR(10),
  trash VARCHAR(10),
  gas VARCHAR(10),
  comments VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;


-- These were updated/renamed

RENAME TABLE uj_h_ind_homeowner TO uj_h_ind_lite

CREATE TABLE IF NOT EXISTS uj_h_ind_lite (
  id INT NOT NULL AUTO_INCREMENT,
  h_ind_email VARCHAR(120) NOT NULL,
  h_ind_firstname VARCHAR(100),
  h_ind_lastname VARCHAR(100),
  h_ind_phone BIGINT(10),
  h_ind_month VARCHAR(20),
  h_ind_day INT(2),
  h_ind_year INT(4),
  h_ind_properties VARCHAR(20),
  h_ind_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (h_ind_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

RENAME TABLE uj_h_comp_homeowner TO uj_h_comp_lite

CREATE TABLE IF NOT EXISTS uj_h_comp_lite (
  id INT NOT NULL AUTO_INCREMENT,
  h_comp_email VARCHAR(120) NOT NULL,  
  h_comp_companyname VARCHAR(100) NOT NULL,
  h_comp_phone BIGINT(10),  
  h_comp_properties VARCHAR(20),
  h_comp_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (h_comp_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

RENAME TABLE uj_l_ind_landlords TO uj_l_ind_pro

CREATE TABLE IF NOT EXISTS uj_l_ind_pro (
  id INT NOT NULL AUTO_INCREMENT,
  l_ind_email VARCHAR(120) NOT NULL,
  l_ind_firstname VARCHAR(100),
  l_ind_lastname VARCHAR(100),
  l_ind_phone BIGINT(10),
  l_ind_month VARCHAR(20),
  l_ind_day INT(2),
  l_ind_year INT(4),
  l_ind_properties VARCHAR(20),
  l_ind_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (l_ind_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

RENAME TABLE uj_l_comp_landlords TO uj_l_comp_pro

CREATE TABLE IF NOT EXISTS uj_l_comp_pro (
  id INT NOT NULL AUTO_INCREMENT,
  l_comp_email VARCHAR(120) NOT NULL,  
  l_comp_companyname VARCHAR(100) NOT NULL,
  l_comp_phone BIGINT(10),  
  l_comp_properties VARCHAR(20),
  l_comp_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (l_comp_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

RENAME TABLE uj_w_ind_wholesaler TO uj_w_ind_executive

CREATE TABLE IF NOT EXISTS uj_w_ind_executive (
  id INT NOT NULL AUTO_INCREMENT,
  w_ind_email VARCHAR(120) NOT NULL,
  w_ind_firstname VARCHAR(100),
  w_ind_lastname VARCHAR(100),
  w_ind_phone BIGINT(10),
  w_ind_month VARCHAR(20),
  w_ind_day INT(2),
  w_ind_year INT(4),
  w_ind_properties VARCHAR(20),
  w_ind_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (w_ind_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

RENAME TABLE uj_w_comp_wholesaler TO uj_w_comp_executive

CREATE TABLE IF NOT EXISTS uj_w_comp_executive (
  id INT NOT NULL AUTO_INCREMENT,
  w_comp_email VARCHAR(120) NOT NULL,  
  w_comp_companyname VARCHAR(100) NOT NULL,
  w_comp_phone BIGINT(10),  
  w_comp_properties VARCHAR(20),
  w_comp_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (w_comp_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

-- These were removed

CREATE TABLE IF NOT EXISTS uj_e_ind_enterprise (
  id INT NOT NULL AUTO_INCREMENT,
  e_ind_email VARCHAR(120) NOT NULL,
  e_ind_firstname VARCHAR(100),
  e_ind_lastname VARCHAR(100),
  e_ind_phone BIGINT(10),
  e_ind_month VARCHAR(20),
  e_ind_day INT(2),
  e_ind_year INT(4),
  e_ind_properties VARCHAR(20),
  e_ind_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (e_ind_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS uj_e_comp_enterprise (
  id INT NOT NULL AUTO_INCREMENT,
  e_comp_email VARCHAR(120) NOT NULL,  
  e_comp_companyname VARCHAR(100) NOT NULL,
  e_comp_phone BIGINT(10),  
  e_comp_properties VARCHAR(20),
  e_comp_proptype VARCHAR(20),
  accepted_tc VARCHAR(10),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE (e_comp_email)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;