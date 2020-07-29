
CREATE TABLE IF NOT EXISTS eom_services (
  id INT NOT NULL AUTO_INCREMENT,
  services VARCHAR(120) NOT NULL,
  service_value VARCHAR(10) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci AUTO_INCREMENT = 1;


INSERT INTO eom_services (id, services, service_value, created_at, updated_at) VALUES
(1, 'Painting', '20', '2020-07-21 00:30:07', '2020-07-21 00:30:07'),
(2, 'Drywall', '45', '2020-07-21 00:30:07', '2020-07-21 00:30:07'),
(3, 'Sheetrock', '33.05', '2020-07-21 00:30:07', '2020-07-21 00:30:07');
