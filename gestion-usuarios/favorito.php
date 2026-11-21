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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $id_usuario = $_SESSION['usuario_id'];

    if ($id > 0) {
        require_once("conexion.php");

        $stmt = $conexion->prepare("UPDATE contactos SET favorito = IF(favorito = 1, 0, 1) WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $id, $id_usuario);
        $stmt->execute();

        $stmt->close();
        $conexion->close();
    }
}

$params = [];
if (!empty($_GET['buscar'])) {
    $params['buscar'] = $_GET['buscar'];
}
if (!empty($_GET['orden']) && $_GET['orden'] !== 'fecha_desc') {
    $params['orden'] = $_GET['orden'];
}
if (!empty($_GET['favoritos']) && $_GET['favoritos'] === '1') {
    $params['favoritos'] = '1';
}

$queryString = !empty($params) ? '?' . http_build_query($params) : '';
header("Location: lista_usuario.php" . $queryString);
exit;
?>