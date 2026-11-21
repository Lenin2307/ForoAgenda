<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$correo_admin = 'lxjaramillo@gmail.com';

if (!isset($_SESSION['usuario_correo']) || strtolower(trim($_SESSION['usuario_correo'])) !== strtolower($correo_admin)) {
    header("Location: lista_usuario.php");
    exit;
}

require_once("conexion.php");

$sql = "SELECT id, nombre, apellidos, correo, fecha_registro FROM usuarios ORDER BY id ASC";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados | Agenda de Contactos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="container-tabla">
        <div class="table-card">
            
            <div class="table-header">
                <div>
                    <h2>Usuarios Registrados</h2>
                    <p class="user-welcome">
                        Sesión activa: <strong><?= htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>
                <div>
                    <a href="lista_usuario.php" class="btn-action btn-edit">← Volver a Mi Agenda</a>
                    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </div>

            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($fila['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['apellidos'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['fecha_registro'] ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert-info">
                    No hay usuarios registrados en la base de datos.
                </div>
            <?php endif; ?>

            <?php $conexion->close(); ?>

        </div>
    </div>

</body>
</html>