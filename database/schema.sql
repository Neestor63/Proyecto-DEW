-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS mi_proyecto_db;
USE mi_proyecto_db;

-- 1. Crear tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    plataforma VARCHAR(50),
    imagen_url VARCHAR(255)
);

-- 2. Crear tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'cliente') DEFAULT 'cliente'
);

-- 3. Insertar los productos de la imagen
INSERT INTO productos (nombre, precio, plataforma, imagen_url) VALUES
('Inazuma Eleven', 90.00, 'Nintendo DS', 'inazuma_1.jpg'),
('Inazuma Eleven 2', 15.99, 'Nintendo DS', 'inazuma_2.jpg'),
('Inazuma Eleven 3', 20.99, 'Nintendo DS', 'inazuma_3.jpg'),
('Inazuma Eleven Go', 25.99, 'Nintendo 3DS', 'inazuma_go.jpg'),
('Inazuma Eleven Go CS', 30.99, 'Nintendo 3DS', 'inazuma_cs.jpg'),
('Inazuma Eleven Strikers', 38.99, 'Wii', 'inazuma_strikers.jpg');

-- 4. Crear los usuarios solicitados
-- Nota: En un entorno real las contraseñas deberían estar encriptadas
INSERT INTO usuarios (username, password, rol) VALUES
('root', '1234', 'admin'),
('nestor', '1234', 'cliente');
