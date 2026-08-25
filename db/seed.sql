-- Datos de ejemplo para PostgreSQL

-- Usuarios (contraseñas hasheadas con password_hash de PHP)
-- admin@ilerna.com / admin123
-- juan@gmail.com / cliente123
INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Admin Ilerna', 'admin@ilerna.com', '$2b$10$L9f.i2VzqKPlKgXWNda9ceDda4qt9aMwAXzopw063FeKFwXxbFm/q', 'admin'),
('Juan Manuel Cordero', 'juan@gmail.com', '$2b$10$mv2vZgV6rC4QlWCtpdlA.e.MEhA7yFEynDlZrYQRB9nytRUliFEEC', 'cliente'),
('Maria del Mar Guerrero', 'maria@gmail.com', '$2b$10$mv2vZgV6rC4QlWCtpdlA.e.MEhA7yFEynDlZrYQRB9nytRUliFEEC', 'cliente');

-- Inmuebles de ejemplo
INSERT INTO inmuebles (tipo, titulo, descripcion, precio, habitaciones, banos, ciudad, id_usuario) VALUES
('chalet', 'Chalet con piscina en Chiclana', 'Precioso chalet independiente con piscina privada, jardín y parking. Zona residencial tranquila a 10 min de la playa.', 350000.00, 4, 3, 'Chiclana de la Frontera', 1),
('piso', 'Ático con vistas al centro', 'Ático luminoso en el centro de Chiclana, con terraza panorámica y vistas a la ciudad. Reformado con materiales de calidad.', 185000.00, 2, 1, 'Chiclana de la Frontera', 1),
('casa', 'Finca rústica con olivar', 'Finca de 3000m² con olivar, dos viviendas y pozo de agua. Ideal para quien busque tranquilidad y naturaleza.', 220000.00, 5, 2, 'Chiclana de la Frontera', 1),
('piso', 'Piso familiar cerca del mar', 'Piso amplio y luminoso a 5 minutos de la playa de la Barrosa. Comunidad con piscina y zonas verdes.', 210000.00, 3, 2, 'Chiclana de la Frontera', 1),
('chalet', 'Chalet adosado con jardín', 'Chalet adosado en urbanización cerrada con jardín privado, garaje y trastero. Certificado energético A.', 275000.00, 3, 2, 'Chiclana de la Frontera', 1);

-- Fotos (usando los nombres de archivo que ya existen en assets/img/)
INSERT INTO fotos (ruta, es_principal, id_inmueble) VALUES
('45_principal_fachada_PPAL.jpg', true, 1),
('45_gal_1_aerea.jpg', false, 1),
('45_gal_5_cocina.jpg', false, 1),
('45_gal_14_salon.jpg', false, 1),
('46_principal_fachada-PPAL.jpg', true, 2),
('46_gal_4_dormitorio-2.jpg', false, 2),
('47_principal_panoramica_PPAL.jpg', true, 3),
('47_gal_2_cocina.jpg', false, 3),
('48_principal_interior-1_PPAL.jpg', true, 4),
('49_principal_salon_PPAL.jpg', true, 5),
('49_gal_3_cocina.jpg', false, 5);
