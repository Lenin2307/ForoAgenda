<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    require_once("conexion.php");

    $id = intval($_GET['id']);
    $id_usuario = $_SESSION['usuario_id'];

    $stmt = $conexion->prepare("DELETE FROM contactos WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id, $id_usuario);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}

header("Location: lista_usuario.php");
exit;
?>