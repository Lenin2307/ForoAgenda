<?php

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basedatos = "usuariosdb";
    $puerto = 3307;

    $conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos, $puerto);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos.");
    }

    $conexion->set_charset("utf8mb4");

?>