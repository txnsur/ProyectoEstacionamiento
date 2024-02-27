// Notification API

//Asignamos nuestro contenedor del documento a la const boton.
const boton = document.querySelector('#enviar');

//Anadimos un evento al boton
boton.addEventListener('click', function() {
    //Le pedimos permiso al usuario para enviarle notificaciones.
    Notification.requestPermission()
    .then(resultado => console.log(`El resultado es ${resultado}`))
});


//Si el usuario ha aceptado el permiso de poder enviarle notificaciones.
if(Notification.permission == 'granted') {
    new Notification('Has iniciado sesion', {
        icon: 'img/Pikachu_Ico.ico',
        body: 'Bienvenido a Parking Manager'
    })
}