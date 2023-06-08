CREATE DATABASE scorebook_db;

USE scorebook_db;

CREATE TABLE games (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  date DATE,
  time TIME,
  location VARCHAR(255),
  opponent VARCHAR(255)
);
