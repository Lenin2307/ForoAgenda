# Agenda de Contactos Web

## 1. Descripción del proyecto
Aplicación web de gestión de agenda personal de contactos desarrollada en PHP y MySQL con sistema de autenticación y control de sesiones. Permite a cada usuario registrarse, iniciar sesión de forma segura y administrar únicamente sus propios contactos (crear, listar, editar y eliminar), garantizando el aislamiento de datos entre usuarios mediante llaves foráneas y validaciones en el servidor.

Incluye medidas de seguridad como encriptación de contraseñas (`password_hash` / `password_verify`), consultas preparadas con `mysqli` para prevenir inyección SQL, escape de salidas HTML (`htmlspecialchars`) contra ataques XSS y control de acceso por sesión y rol administrativo.

---

## 2. Tecnologías utilizadas
* **Backend:** PHP 8+ (extensión `mysqli` y manejo de sesiones `$_SESSION`).
* **Base de datos:** MySQL / usuariosdb.
* **Frontend:** HTML5, CSS3 (diseño responsivo personalizado) y JavaScript (validación de contraseñas en tiempo real y cuadros de confirmación).
* **Entorno de servidor:** Apache (XAMPP).
* **Control de versiones:** Git y GitHub.

---

## 3. Utlización de lenguajes:
* **Lenguajes utilizados:** PHP- 67.2%
* **Lenguajes utilizados:** CSS- 18.8%
* **Lenguajes utilizados:** HTML- 14%

---
## 4. Requisitos para su ejecución
* **XAMPP** (o cualquier servidor local equivalente con Apache, PHP y MySQL/MariaDB).
* **PHP** versión 8.0 o superior.
* **MySQL / usuariosdb** activo (configurado en el puerto `3307`, modificable en `conexion.php`).
* **Navegador web** actualizado (Google Chrome, Microsoft Edge, Mozilla Firefox, etc.).
* **Descomprimir el archivo y abrirlo en VS studio o Antigravity ID**

---

## 5. Pasos para instalar la aplicación y tambien si lo descargaste como archivo .zip 

1. **Ubicar el proyecto en el servidor local:**
   Clona este repositorio o copia la carpeta del proyecto dentro del directorio `htdocs` de XAMPP:
   ```bash
   cd C:\xampp\htdocs
   git clone [https://github.com/Lenin2307/ForoAgenda.git](https://github.com/Lenin2307/ForoAgenda.git) agendaContactos

2. **Iniciar los servicios en XAMPP**
* **Abre el Panel de Control de XAMPP**
* **Haz clic en Start en los módulos Apache y MySQL**

3. **Importar la base de datos en phpMyAdmin**
* **Abre tu navegador web e ingresa a phpMyAdmin:** http://localhost/phpmyadmin.
* **En el menú lateral izquierdo, haz clic en Nueva, asigna el nombre usuariosdb (con cotejamiento utf8mb4_general_ci) y presiona Crear.**
+ **Con la base de datos usuariosdb seleccionada, haz clic en la pestaña Importar en el menú superior.**
* **Presiona Seleccionar archivo y elige el script gestion-usuarios/usuariosdb.sql ubicado dentro de la carpeta del proyecto.**
* **Desplázate hasta el final de la página y haz clic en Importar (o Continuar) para generar automáticamente las tablas usuarios y contactos.**

3. **Verificar la conexión a la base de datos**
**Abre el archivo gestion-usuarios/conexion.php en un editor de código y verifica que los parámetros coincidan con tu configuración local de MySQL:**
* **Servidor:** localhost
* **Contraseña:** "" (vacía por defecto en XAMPP)
* **Base de datos:** usuariosdb
* **Puerto:** (si tu instalación de XAMPP utiliza el puerto estándar, cámbialo a 3306)

6. **Cómo acceder a la aplicación**
**Con los servicios de Apache y MySQL activos, abre tu navegador web e ingresa a cualquiera de las siguientes direcciones:**
* **Página principal de bienvenida:** http://localhost/agendaContactos/gestion-usuarios/
* **Registro de usuario nuevo:** http://localhost/agendaContactos/gestion-usuarios/registro_usuario.html
* **Inicio de sesión:** http://localhost/agendaContactos/gestion-usuarios/login.php

**Flujo de la aplocacion**
* **Accede a Crear Cuenta Nueva (registro_usuario.html) y registra un usuario con un correo válido.**
* **Inicia sesión con tus credenciales desde login.php.**
* **En el panel principal (lista_usuario.php), agrega nuevos contactos, edita los existentes o elimínalos según necesites.**
* **Finaliza tu sesión haciendo clic en el botón Cerrar Sesión.**