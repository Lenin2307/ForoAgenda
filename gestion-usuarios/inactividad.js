let tiempoInactividad;
const LIMITE_INACTIVIDAD = 90000;

function cerrarSesionPorInactividad() {
    window.location.href = "logout.php";
}

function reiniciarTemporizador() {
    clearTimeout(tiempoInactividad);
    tiempoInactividad = setTimeout(cerrarSesionPorInactividad, LIMITE_INACTIVIDAD);
}

["keydown", "keyup", "input", "mousemove", "mousedown", "click", "scroll", "touchstart"].forEach((evento) => {
    window.addEventListener(evento, reiniciarTemporizador, true);
});

reiniciarTemporizador();