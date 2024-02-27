// Solicita permiso al usuario para enviar notificaciones
Notification.requestPermission().then(permission => {
    if(permission === "granted") {
        // El usuario ha dado permiso
        new Notification("No se ha encontrado el usuario", {
            body: "Vuelve a intentarlo..."
        });
    } else {
        // El usuario ha denegado el permiso o no ha respondido
        console.log("Permiso de notificación denegado");
    }
});

setTimeout(function() {
    window.location.href = '../view/loginAcceso.php';
}, 0); // espera 5 segundos antes de redirigir