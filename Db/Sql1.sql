-- Creamos la base de datos llamada bd1
CREATE DATABASE IF NOT EXISTS bd1;
USE bd1;

-- Creamos la tabla usuarios para registrar los datos del formulario
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,             -- Identificador único del usuario
    nombre_usuario VARCHAR(50) NOT NULL,           -- Nombre o apodo del usuario
    correo_electronico VARCHAR(100) NOT NULL,      -- Correo electrónico del usuario
    contrasena VARCHAR(255) NOT NULL,              -- Contraseña en formato encriptado (hash)
    idioma VARCHAR(50) NOT NULL DEFAULT 'es'
);
CREATE TABLE progreso_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nivel INT NOT NULL,
    estado ENUM('bloqueado', 'desbloqueado', 'completado') DEFAULT 'bloqueado',
    modo ENUM('facil', 'medio', 'dificil') NOT NULL,
    idioma VARCHAR(20) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
