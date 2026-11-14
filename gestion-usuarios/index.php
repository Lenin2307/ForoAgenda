<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: lista_usuario.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Agenda de Contactos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="auth-card" style="text-align: center;">
        <div class="auth-header">
            <h2>Agenda de Contactos</h2>
            <p>Organiza y administra tus contactos personales de forma privada y segura</p>
        </div>

        <a href="login.php" class="btn-submit" style="display: block; text-decoration: none; margin-bottom: 12px;">
            Iniciar Sesión
        </a>

        <a href="registro_usuario.html" class="btn-logout" style="display: block; width: 100%; padding: 12px; border-color: #2a5298; color: #2a5298;">
            Crear Cuenta Nueva
        </a>
    </div>

</body>
</html>