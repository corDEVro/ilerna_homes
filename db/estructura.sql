
/* ESTRUCTURA DE LA BASE DE DATOS (Mejor guardarla en un archivo que ponerla directamente en phpMyAdmin) */

-- Creamos la base de datos si no existe ya:
CREATE DATABASE IF NOT EXISTS ilerna_homes;

-- Le decimos al sistema que entre en la base de datos:
USE ilerna_homes;

-- Creamos las tablas:

    -- 1. tabla de usuarios
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        nombre VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        password VARCHAR(255),
        rol ENUM('admin', 'cliente')        -- ENUM permite que decidamos las posibilidades del campo.
    ) ENGINE=InnoDB;

    -- 2. tabla de inmuebles
    CREATE TABLE IF NOT EXISTS inmuebles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo ENUM('casa', 'piso', 'terreno', 'chalet', 'local'),    
        titulo VARCHAR(255),
        descripcion TEXT,
        precio DECIMAL(12, 2),              -- DECIMAL(12, 2) permite hasta 12 dígitos con 2 decimales
        habitaciones INT,
        banos INT,
        ciudad VARCHAR(100),
        id_usuario INT,
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;

    -- 3. tabla de fotos
    CREATE TABLE IF NOT EXISTS fotos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ruta VARCHAR(255) DEFAULT 'default.jpg',    -- Si no se sube foto, se asigna una por defecto que estará en la carpeta assets.
        es_principal BOOLEAN,
        id_inmueble INT,
        FOREIGN KEY (id_inmueble) REFERENCES inmuebles(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;

    -- 4. tabla de favoritos
    CREATE TABLE IF NOT EXISTS favoritos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT,
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
        id_inmueble INT,
        FOREIGN KEY (id_inmueble) REFERENCES inmuebles(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;                    -- Definimos el motor de almacenamiento InnoDB para soportar claves foráneas y transacciones.