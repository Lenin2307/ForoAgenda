<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: lista_usuario.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("conexion.php");

    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $clave = $_POST['clave'];

    if (empty($correo) || empty($clave)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        $stmt = $conexion->prepare("SELECT id, nombre, apellidos, correo, clave FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($usuario = $resultado->fetch_assoc()) {
            if (password_verify($clave, $usuario['clave'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'] . " " . $usuario['apellidos'];
                $_SESSION['usuario_correo'] = $usuario['correo'];

                header("Location: lista_usuario.php");
                exit;
            }
        }
        $error = "Correo electrónico o contraseña incorrectos.";

        $stmt->close();
        $conexion->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Agenda de Contactos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <h2>Bienvenido</h2>
            <p>Ingresa tus credenciales para continuar</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['motivo']) && $_GET['motivo'] === 'inactividad'): ?>
    <div class="alert-error">
        Tu sesión se cerró automáticamente tras 30 segundos de inactividad.
    </div>
<?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com" required>
            </div>

            <div class="form-group">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Iniciar Sesión</button>
        </form>

        <div class="auth-link">
            ¿Aún no tienes una cuenta? <a href="registro_usuario.html">Regístrate aquí</a>
        </div>
    </div>

</body>
</html>
