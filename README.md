# Agenda de Contactos Web

## 1. Descripción del proyecto
Aplicación web de gestión de agenda personal de contactos desarrollada en PHP y MySQL con sistema de autenticación y control de sesiones. Permite a cada usuario registrarse, iniciar sesión de forma segura y administrar únicamente sus propios contactos (crear, listar, editar y eliminar), garantizando el aislamiento de datos entre usuarios mediante llaves foráneas y validaciones en el servidor.

Incluye medidas de seguridad como encriptación de contraseñas (`password_hash` / `password_verify`), consultas preparadas con `mysqli` para prevenir inyección SQL, escape de salidas HTML (`htmlspecialchars`) contra ataques XSS y control de acceso por sesión y rol administrativo.

---

## 2. Tecnologías utilizadas
* **Backend:** PHP 8+ (extensión `mysqli` y manejo de sesiones `$_SESSION`).
* **Base de datos:** MySQL / MariaDB.
* **Frontend:** HTML5, CSS3 (diseño responsivo personalizado) y JavaScript (validación de contraseñas en tiempo real y cuadros de confirmación).
* **Entorno de servidor:** Apache (XAMPP).
* **Control de versiones:** Git y GitHub.

* **Lenguajes utilizados:** PHP- 67.2%
* **Lenguajes utilizados:** CSS- 18.8%
* **Lenguajes utilizados:** HTML- 14%

---
## 3. Requisitos para su ejecución
* **XAMPP** (o cualquier servidor local equivalente con Apache, PHP y MySQL/MariaDB).
* **PHP** versión 8.0 o superior.
* **MySQL / MariaDB** activo (configurado en el puerto `3307`, modificable en `conexion.php`).
* **Navegador web** actualizado (Google Chrome, Microsoft Edge, Mozilla Firefox, etc.).
* **Descomprimir el archivo y abrirlo en VS studio o Antigravity ID**

---

## 4. Pasos para instalar la aplicación

1. **Ubicar el proyecto en el servidor local:**
   Clona este repositorio o copia la carpeta del proyecto dentro del directorio `htdocs` de XAMPP:
   ```bash
   cd C:\xampp\htdocs
   git clone [https://github.com/Lenin2307/ForoAgenda.git](https://github.com/Lenin2307/ForoAgenda.git) agendaContactos

