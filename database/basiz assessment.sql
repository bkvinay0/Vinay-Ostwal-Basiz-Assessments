CREATE DATABASE IF NOT EXISTS basiz_assessment;

USE basiz_assessment;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender VARCHAR(20),
    standard VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    age INT NOT NULL,
    father_name VARCHAR(100),
    father_mobile VARCHAR(10) NOT NULL,
    email VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);