CREATE DATABASE IF NOT EXISTS transaction_db;
USE transaction_db;

CREATE TABLE IF NOT EXISTS users (
  phone VARCHAR(15) PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  balance FLOAT DEFAULT 0
);

-- Sample data
INSERT INTO users (phone, password, balance) VALUES
('01943638487', MD5('1234'), 5000),
('01984682643', MD5('4321'), 1000);
