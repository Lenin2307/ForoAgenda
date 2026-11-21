<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once("conexion.php");
$id_usuario = $_SESSION['usuario_id'];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conexion->prepare("SELECT nombre, telefono, correo, ciudad FROM contactos WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id, $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $contacto = $resultado->fetch_assoc();
    $stmt->close();
}

if (!isset($contacto)) {
    header("Location: lista_usuario.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto | Agenda de Contactos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <h2>Editar Contacto</h2>
            <p>Modifica los datos de tu contacto</p>
        </div>

        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?= htmlspecialchars($contacto['nombre'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="<?= htmlspecialchars($contacto['telefono'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" class="form-control" value="<?= htmlspecialchars($contacto['correo'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?= htmlspecialchars($contacto['ciudad'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <button type="submit" class="btn-submit">Guardar Cambios</button>
        </form>

        <div class="auth-link">
            <a href="lista_usuario.php">Cancelar y volver a la agenda</a>
        </div>
    </div>
    <script src="inactividad.js"></script>

</body>
</html>