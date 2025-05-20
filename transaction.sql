CREATE DATABASE IF NOT EXISTS transaction_db;
USE transaction_db;

CREATE TABLE IF NOT EXISTS users (
  phone VARCHAR(15) PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  balance FLOAT DEFAULT 0
);

-- Sample data
INSERT INTO users (phone, password, balance) VALUES
('01912345678', MD5('1234'), 9000),
('01812345678', MD5('1234'), 8000),
('01712345678', MD5('4321'), 7000),
('01612345678', MD5('4321'), 1000);
