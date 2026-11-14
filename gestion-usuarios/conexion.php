<?php

    // Variables de configuración de la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basedatos = "usuariosdb";
    $puerto = 3307;

    // Crear conexión con MySQL
    $conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos, $puerto);

    // Verificar si existe error de conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos.");
    }

    $conexion->set_charset("utf8mb4");

?>