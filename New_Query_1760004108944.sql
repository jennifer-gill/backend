-- Users table
CREATE TABLE `sales_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('user','admin') NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Checkins table



CREATE TABLE `sales_checkins` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `client` VARCHAR(255) NOT NULL,
  `type` ENUM('in','out') NOT NULL,
  `latitude` DECIMAL(10,7) NOT NULL,
  `longitude` DECIMAL(10,7) NOT NULL,
  `check_in_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_out_time` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE sales_checkins
ADD COLUMN name VARCHAR(100) AFTER user_id;

ALTER TABLE sales_checkins
ADD COLUMN service_type VARCHAR(100) DEFAULT NULL,
ADD COLUMN support_mode VARCHAR(50) DEFAULT NULL,
ADD COLUMN note TEXT DEFAULT NULL;


