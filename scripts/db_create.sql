-- =========================================
--   BASE DE DATOS PARA TIENDA DE CURSOS
-- =========================================

CREATE DATABASE IF NOT EXISTS tienda_cursos;
USE tienda_cursos;

-- =========================================
--   TABLA: usuarios
-- =========================================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('usuario','admin') DEFAULT 'usuario',

    pregunta_seguridad VARCHAR(255) NOT NULL,
    respuesta_seguridad VARCHAR(255) NOT NULL,

    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
--   TABLA: categorias
-- =========================================
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- =========================================
--   TABLA: cursos
-- =========================================
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion_corta VARCHAR(255),
    descripcion_larga TEXT,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255),
    categoria_id INT,
    duracion INT,  -- duración en horas
    nivel ENUM('Básico','Intermedio','Avanzado') DEFAULT 'Básico',

    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- =========================================
--   TABLA: carrito
-- =========================================
CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    curso_id INT NOT NULL,
    cantidad INT DEFAULT 1,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);

-- =========================================
--   TABLA: compras
-- =========================================
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2),

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- =========================================
--   TABLA: compras_detalle
-- =========================================
CREATE TABLE compras_detalle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT NOT NULL,
    curso_id INT NOT NULL,
    cantidad INT DEFAULT 1,
    precio_unitario DECIMAL(10,2),

    FOREIGN KEY (compra_id) REFERENCES compras(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);
