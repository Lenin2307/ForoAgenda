<?php
session_start();
session_unset();
session_destroy();

if (isset($_GET['motivo']) && $_GET['motivo'] === 'inactividad') {
    header("Location: login.php?motivo=inactividad");
} else {
    header("Location: login.php");
}
exit;
?>