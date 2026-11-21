<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once("conexion.php");
$id_usuario = $_SESSION['usuario_id'];
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');

    if ($nombre !== '' && $telefono !== '' && filter_var($correo, FILTER_VALIDATE_EMAIL) && $ciudad !== '') {
        $insert = $conexion->prepare("INSERT INTO contactos (id_usuario, nombre, telefono, correo, ciudad) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("issss", $id_usuario, $nombre, $telefono, $correo, $ciudad);
        if ($insert->execute()) {
            $insert->close();
            $conexion->close();
            header("Location: lista_usuario.php");
            exit;
        } else {
            $error = "Error al guardar el contacto en la base de datos.";
        }
        $insert->close();
    } else {
        $error = "Completa todos los campos del contacto con un correo válido.";
    }
}

$buscar = trim($_GET['buscar'] ?? '');
$orden  = $_GET['orden'] ?? 'fecha_desc';

switch ($orden) {
    case 'nombre_asc':
        $columnaOrden = "nombre ASC";
        break;
    case 'nombre_desc':
        $columnaOrden = "nombre DESC";
        break;
    case 'ciudad_asc':
        $columnaOrden = "ciudad ASC";
        break;
    case 'ciudad_desc':
        $columnaOrden = "ciudad DESC";
        break;
    case 'fecha_asc':
        $columnaOrden = "fecha_creacion ASC";
        break;
    default:
        $orden = 'fecha_desc';
        $columnaOrden = "fecha_creacion DESC";
        break;
}

if ($buscar !== '') {
    $termino = "%" . $buscar . "%";
    $sql = "SELECT id, nombre, telefono, correo, ciudad, fecha_creacion 
            FROM contactos 
            WHERE id_usuario = ? AND (nombre LIKE ? OR correo LIKE ? OR ciudad LIKE ?) 
            ORDER BY $columnaOrden";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isss", $id_usuario, $termino, $termino, $termino);
} else {
    $sql = "SELECT id, nombre, telefono, correo, ciudad, fecha_creacion 
            FROM contactos 
            WHERE id_usuario = ? 
            ORDER BY $columnaOrden";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
}

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

            <form action="lista_usuario.php" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 10px; margin-bottom: 25px;">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre del contacto" required>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
                <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
                <input type="text" name="ciudad" class="form-control" placeholder="Ciudad" required>
                <button type="submit" class="btn-new" style="border: none; cursor: pointer;">+ Agregar Contacto</button>
            </form>

            <form method="GET" action="lista_usuario.php" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 18px; align-items: center;">
                <input 
                    type="text" 
                    name="buscar" 
                    placeholder="Buscar por nombre, correo o ciudad..." 
                    value="<?= htmlspecialchars($buscar, ENT_QUOTES, 'UTF-8') ?>"
                    style="flex: 1; min-width: 220px; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"
                >

                <select name="orden" style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                    <option value="fecha_desc" <?= $orden === 'fecha_desc' ? 'selected' : '' ?>>Más recientes primero</option>
                    <option value="fecha_asc" <?= $orden === 'fecha_asc' ? 'selected' : '' ?>>Más antiguos primero</option>
                    <option value="nombre_asc" <?= $orden === 'nombre_asc' ? 'selected' : '' ?>>Nombre (A - Z)</option>
                    <option value="nombre_desc" <?= $orden === 'nombre_desc' ? 'selected' : '' ?>>Nombre (Z - A)</option>
                    <option value="ciudad_asc" <?= $orden === 'ciudad_asc' ? 'selected' : '' ?>>Ciudad (A - Z)</option>
                    <option value="ciudad_desc" <?= $orden === 'ciudad_desc' ? 'selected' : '' ?>>Ciudad (Z - A)</option>
                </select>

                <button type="submit" class="btn-action btn-edit" style="border: none; cursor: pointer; padding: 10px 16px;">
                    Filtrar
                </button>

                <?php if ($buscar !== '' || $orden !== 'fecha_desc'): ?>
                    <a href="lista_usuario.php" class="btn-logout" style="padding: 9px 14px; text-decoration: none;">
                        Limpiar
                    </a>
                <?php endif; ?>
            </form>

            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Ciudad</th>
                                <th>Fecha de Creación</th>
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
                                    <td><?= htmlspecialchars($fila['fecha_creacion'] ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="text-center">
                                        <a href="editar.php?id=<?= htmlspecialchars($fila['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-action btn-edit">Actualizar</a>
                                        <a href="borrar.php?id=<?= htmlspecialchars($fila['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-action btn-delete" onclick="return confirm('¿Deseas eliminar este contacto?')">Borrar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($buscar !== ''): ?>
                <div class="alert-info">
                    No se encontraron contactos que coincidan con <strong>"<?= htmlspecialchars($buscar, ENT_QUOTES, 'UTF-8') ?>"</strong>. Haz clic en <strong>Limpiar</strong> para ver toda tu lista.
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
    <script src="inactividad.js"></script>

</body>
</html>