<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$tiempo_maximo = 30;
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > $tiempo_maximo) {
    session_unset();
    session_destroy();
    header("Location: login.php?motivo=inactividad");
    exit;
}
$_SESSION['ultimo_acceso'] = time();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id'] ?? 0);
    $id_usuario = $_SESSION['usuario_id'];
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');
    $favorito = (isset($_POST['favorito']) && $_POST['favorito'] === '1') ? 1 : 0;

    if ($id <= 0 || $nombre === '' || $telefono === '' || $correo === '' || $ciudad === '') {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>Error: Todos los campos son obligatorios.</p>";
        echo "<p style='text-align:center;'><a href='editar.php?id=" . $id . "'>Volver al formulario de edición</a></p>";
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>Error: El formato del correo electrónico no es válido.</p>";
        echo "<p style='text-align:center;'><a href='editar.php?id=" . $id . "'>Volver al formulario de edición</a></p>";
        exit;
    }

    require_once("conexion.php");

    $stmt = $conexion->prepare("UPDATE contactos SET nombre = ?, telefono = ?, correo = ?, ciudad = ?, favorito = ? WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ssssiii", $nombre, $telefono, $correo, $ciudad, $favorito, $id, $id_usuario);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}

header("Location: lista_usuario.php");
exit;
?>