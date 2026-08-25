/* ESTRUCTURA DE LA BASE DE DATOS - PostgreSQL */

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    rol VARCHAR(10) CHECK (rol IN ('admin', 'cliente'))
);

-- Tabla de inmuebles
CREATE TABLE IF NOT EXISTS inmuebles (
    id SERIAL PRIMARY KEY,
    tipo VARCHAR(10) CHECK (tipo IN ('casa', 'piso', 'terreno', 'chalet', 'local')),
    titulo VARCHAR(255),
    descripcion TEXT,
    precio DECIMAL(12, 2),
    habitaciones INT,
    banos INT,
    ciudad VARCHAR(100),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de fotos
CREATE TABLE IF NOT EXISTS fotos (
    id SERIAL PRIMARY KEY,
    ruta VARCHAR(255) DEFAULT 'default.jpg',
    es_principal BOOLEAN,
    id_inmueble INT,
    FOREIGN KEY (id_inmueble) REFERENCES inmuebles(id) ON DELETE CASCADE
);

-- Tabla de favoritos
CREATE TABLE IF NOT EXISTS favoritos (
    id SERIAL PRIMARY KEY,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    id_inmueble INT,
    FOREIGN KEY (id_inmueble) REFERENCES inmuebles(id) ON DELETE CASCADE
);
