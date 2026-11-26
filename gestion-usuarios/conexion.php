<?php

    $servidor = "sql211.infinityfree.com";
    $usuario = "if0_43500573";
    $contrasena = "2307L3nin1996 ";
    $basedatos = "if0_43500573_usuariosdb";
    $puerto = 3306;

    $conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos, $puerto);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos.");
    }

    $conexion->set_charset("utf8mb4");

?>