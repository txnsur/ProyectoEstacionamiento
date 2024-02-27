// Solicita permiso al usuario para enviar notificaciones
Notification.requestPermission().then(permission => {
    if(permission === "granted") {
        // El usuario ha dado permiso
        new Notification("Bienvenido a Parking Manager " + nickname, {
            body: "Haz iniciado sesion como admin"
        });
    } else {
        // El usuario ha denegado el permiso o no ha respondido
        console.log("Permiso de notificación denegado");
    }
});

setTimeout(function() {
    window.location.href = '../view/admin/clientes.php';
}, 0); // espera 5 segundos antes de redirigir