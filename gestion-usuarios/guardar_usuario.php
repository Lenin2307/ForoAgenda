<?php 
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']); 
    $apellidos = trim($_POST['apellidos']); 
    $correo = trim($_POST['correo'] ??'');
    $clave_plana = $_POST['clave'];
    $confirmar_clave = $_POST['confirmar_clave'];

    if ($nombre === '' || $apellidos === '' || $correo === '' || trim($clave_plana) === '' || trim($confirmar_clave) === '') {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>Error: Todos los campos son obligatorios.</p>";
        echo "<p style='text-align:center;'><a href='registro_usuario.html'>Volver al formulario</a></p>";
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>Error: El formato del correo electrónico no es válido.</p>";
        echo "<p style='text-align:center;'><a href='registro_usuario.html'>Volver al formulario</a></p>";
        exit;
    }

    if ($clave_plana !== $confirmar_clave) {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>Error: Las contraseñas no coinciden.</p>";
        echo "<p style='text-align:center;'><a href='registro_usuario.html'>Volver al formulario</a></p>";
        exit;
    }

    $clave_hashed = password_hash($clave_plana, PASSWORD_DEFAULT); 

    $verificar = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $verificar->bind_param("s", $correo);
    $verificar->execute();
    $verificar->store_result();

    if ($verificar->num_rows > 0) {
        echo "<p style='text-align:center; color:red; margin-top:20px;'>El correo ya está registrado.</p>";
        echo "<p style='text-align:center;'><a href='registro_usuario.html'>Intentar con otro correo</a></p>";
    } else {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, correo, clave) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellidos, $correo, $clave_hashed); 
        
        if ($stmt->execute()) {
            echo "<p style='text-align:center; color:green; margin-top:20px;'>Usuario registrado correctamente.</p>";
            echo "<p style='text-align:center;'><a href='login.php'>Iniciar sesión ahora</a></p>";
        } else {
            echo "<p style='text-align:center; color:red; margin-top:20px;'>Error al registrar el usuario.</p>";
        }
        $stmt->close();
    }
    $verificar->close();
    $conexion->close();
}
?>