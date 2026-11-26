<?php
session_start(); 
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $clave = $_POST['clave'];


    $stmt = $conexion->prepare("SELECT id, nombre, clave FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        
        if (password_verify($clave, $usuario['clave'])) {
    
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];

        
            header("Location: listar_usuarios.php");
            exit;
        } else {
            echo "<p style='text-align:center; color:red; margin-top:20px;'>Contraseña incorrecta.</p>";
            echo "<p style='text-align:center;'><a href='login.html'>Volver a intentar</a></p>";
        }
    } else {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>No existe una cuenta con ese correo.</p>";
        echo "<p style='text-align:center;'><a href='login.html'>Volver a intentar</a></p>";
    }

    $stmt->close();
    $conexion->close();
}
?>
