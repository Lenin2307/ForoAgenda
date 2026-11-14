<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once("conexion.php");
$id_usuario = $_SESSION['usuario_id'];
$error = "";

// Guardar un nuevo contacto perteneciente al usuario en sesión
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = filter_var(trim($_POST['correo'] ?? ''), FILTER_SANITIZE_EMAIL);
    $ciudad = trim($_POST['ciudad'] ?? '');

    if (!empty($nombre) && !empty($telefono) && filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($ciudad)) {
        $insert = $conexion->prepare("INSERT INTO contactos (id_usuario, nombre, telefono, correo, ciudad) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("issss", $id_usuario, $nombre, $telefono, $correo, $ciudad);
        if ($insert->execute()) {
            $insert->close();
            $conexion->close();
            header("Location: lista_usuario.php");
            exit;
        }
        $insert->close();
    } else {
        $error = "Completa todos los campos del contacto con un correo válido.";
    }
}

// Mostrar únicamente los contactos del usuario conectado
$stmt = $conexion->prepare("SELECT id, nombre, telefono, correo, ciudad FROM contactos WHERE id_usuario = ? ORDER BY id DESC");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Agenda | Agenda de Contactos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="container-tabla">
        <div class="table-card">
            
            <div class="table-header">
                <div>
                    <h2>Mi Agenda de Contactos</h2>
                    <p class="user-welcome">
                        Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8') ?></strong>
                        <?php if (!empty($_SESSION['usuario_correo'])): ?>
                            (<?= htmlspecialchars($_SESSION['usuario_correo'], ENT_QUOTES, 'UTF-8') ?>)
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <?php if (($_SESSION['usuario_correo'] ?? '') === 'lxjaramillo@gmail.com'): ?>
                        <a href="ver_usuarios.php" class="btn-action btn-edit">Ver Usuarios</a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <!-- Formulario para agregar un contacto personal -->
            <form action="lista_usuario.php" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 10px; margin-bottom: 25px;">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre del contacto" required>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
                <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
                <input type="text" name="ciudad" class="form-control" placeholder="Ciudad" required>
                <button type="submit" class="btn-new" style="border: none; cursor: pointer;">+ Agregar Contacto</button>
            </form>

            <!-- Tabla con los contactos de este usuario -->
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Ciudad</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['telefono'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($fila['ciudad'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="text-center">
                                        <a href="editar.php?id=<?= htmlspecialchars($fila['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-action btn-edit">Actualizar</a>
                                        <a href="borrar.php?id=<?= htmlspecialchars($fila['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-action btn-delete" onclick="return confirm('¿Deseas eliminar este contacto?')">Borrar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert-info">
                    No tienes contactos guardados aún. Llena los campos de arriba y haz clic en <strong>+ Agregar Contacto</strong>.
                </div>
            <?php endif; ?>

            <?php
            $stmt->close();
            $conexion->close();
            ?>

        </div>
    </div>

</body>
</html>