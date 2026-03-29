# 🏠 Ilerna Homes - Gestión Inmobiliaria

![Versión](https://img.shields.io/badge/version-1.0.0-blue)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap)

**Ilerna Homes** es una solución integral diseñada para la digitalización de pequeñas inmobiliarias. Este proyecto nace de la necesidad de gestionar su catálogo de viviendas de forma independiente, profesional y segura, sin depender de costosos portales de terceros.

---

## 🚀 Características Principales

- **Panel de Administración (CRUD):** Control total sobre el inventario. Permite añadir, editar y eliminar inmuebles en tiempo real.
- **Sistema de Usuarios y Roles:** Diferenciación clara entre Administrador (gestión) y Clientes (consulta).
- **Seguridad Avanzada:** Implementación de contraseñas encriptadas mediante `password_hash` y protección de rutas mediante sesiones PHP.
- **Galería Dinámica:** Sistema automático de gestión de imágenes alojadas en servidor local.
- **Diseño Responsive:** Interfaz moderna adaptada a móviles y tablets utilizando Bootstrap 5.

---

## 🛠️ Stack Tecnológico (Arquitectura WAMP)

El proyecto se ha desarrollado bajo un entorno de ciclo completo (**Full-stack**):

- **Backend:** PHP 8 (con PDO para sentencias preparadas y seguridad contra Inyección SQL).
- **Base de Datos:** MySQL (Arquitectura relacional).
- **Frontend:** HTML5, CSS3, JavaScript y Framework Bootstrap 5.
- **Servidor Web:** Apache (XAMPP).
- **Túnel de Despliegue:** Ngrok (para validación externa con el cliente).

---

## 📂 Estructura del Proyecto

```text
ilerna_homes/
├── admin/             # Lógica y formularios de administración (CRUD)
├── assets/            # Recursos estáticos (CSS, JS, Imágenes de casas)
├── config/            # Conexión a la base de datos (PDO)
├── includes/          # Componentes reutilizables (Header, Footer, Navbar)
├── views/             # Vistas públicas para el usuario final
└── index.php          # Página principal de la inmobiliaria
