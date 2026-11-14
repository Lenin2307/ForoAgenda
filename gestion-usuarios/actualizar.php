<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("conexion.php");

    $id = intval($_POST['id']);
    $id_usuario = $_SESSION['usuario_id'];
    $nombre = trim($_POST['nombre']); 
    $telefono = trim($_POST['telefono']); 
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL); 
    $ciudad = trim($_POST['ciudad']); 

    $stmt = $conexion->prepare("UPDATE contactos SET nombre = ?, telefono = ?, correo = ?, ciudad = ? WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ssssii", $nombre, $telefono, $correo, $ciudad, $id, $id_usuario);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}

header("Location: lista_usuario.php");
exit;
?>