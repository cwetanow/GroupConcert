CREATE DATABASE IF NOT EXISTS `group-concert-db` COLLATE utf8mb4_unicode_ci;
USE `group-concert-db`;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  email VARCHAR(50),
  full_name VARCHAR(50),
  password VARCHAR(128)
);

CREATE TABLE concerts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  start_date DATE,
  host_id INT NOT NULL,
  address VARCHAR(128),
  title VARCHAR(128),
  city VARCHAR(128),
  spots INT,
  joined_spots INT DEFAULT 0,
  performer_id INT,
  FOREIGN KEY (host_id) REFERENCES users(id)
);

CREATE TABLE concert_participants (
  user_id INT NOT NULL,
  concert_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (concert_id) REFERENCES concerts(id)
);

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  concert_id INT NOT NULL,
  comment_date DATE,
  user_id INT NOT NULL,
  comment_text VARCHAR(500),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE concert_perform_requests (
  user_id INT NOT NULL,
  concert_id INT NOT NULL,
  status INT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (concert_id) REFERENCES concerts(id)
);