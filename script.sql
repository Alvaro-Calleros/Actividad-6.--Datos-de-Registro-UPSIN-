CREATE DATABASE IF NOT EXISTS upsin_registro;
USE upsin_registro;

CREATE TABLE personas (
	id INT AUTO_INCREMENT PRIMARY KEY,
	identificador VARCHAR(50) NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	correo VARCHAR(100) NOT NULL,
	edad INT NOT NULL,
	genero VARCHAR(20),
	hobbies TEXT,
	carrera VARCHAR(100) NOT NULL,
	bio TEXT,
	foto_path VARCHAR(255),
	fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO personas (identificador, nombre, correo, edad, genero, hobbies, carrera, bio, foto_path) VALUES
('ID001', 'Evelin Fajardo', 'evelin@ejemplo.com', 20, 'Femenino', 'Deportes, Música', 'Ingeniería en Mecatrónica', 'Estudiante apasionada por la tecnología', 'uploads/eve.jpeg'),
('ID002', 'Alvaro Calleros', 'alvaro@ejemplo.com', 22, 'Masculino', 'Lectura, Videojuegos, Programación', 'Ingeniería en Tecnologías de la Información', 'Interesado en optimización de procesos', 'uploads/alvaro.jpeg'),
('ID003', 'Abraham Mendez', 'abraham@ejemplo.com', 19, 'Masculino', 'Arte, Música, Cine', 'Ingeniería en Tecnologías de la Información', 'Creativo', 'uploads/abraham.jpeg');