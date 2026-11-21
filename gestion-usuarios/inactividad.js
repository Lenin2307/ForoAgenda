let temporizadorInactividad;
const TIEMPO_LIMITE = 30000;

function cerrarPorInactividad() {
    window.location.href = "logout.php?motivo=inactividad";
}

function reiniciarTemporizador() {
    clearTimeout(temporizadorInactividad);
    temporizadorInactividad = setTimeout(cerrarPorInactividad, TIEMPO_LIMITE);
}

const eventosActividad = ["mousemove", "mousedown", "keydown", "scroll", "touchstart", "click"];
eventosActividad.forEach(evento => {
    document.addEventListener(evento, reiniciarTemporizador, true);
});

reiniciarTemporizador();