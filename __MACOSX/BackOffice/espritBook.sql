CREATE DATABASE IF NOT EXISTS EspritBook;
USE EspritBook;

CREATE TABLE IF NOT EXISTS Book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publication_date DATE NOT NULL,
    language ENUM('AN','FR') NOT NULL,
    status ENUM('Disponible','Indisponible') NOT NULL,
    copies INT NOT NULL CHECK (copies >= 1),
    category VARCHAR(50) NOT NULL
);