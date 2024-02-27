document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formUsuario");
    const nickname = document.getElementById("nickname");
    const email = document.getElementById("email");
    const mensajeError = document.getElementById("mensajeError");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault(); // Prevenir el envío normal del formulario
  
      const datos = new FormData();
      datos.append('nickname', nickname.value);
      datos.append('email', email.value);
  
      fetch('../app/checkUserExist.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json()) // Asegúrate de procesar la respuesta como JSON
    .then(data => {
        if (data.status === 'duplicate') {
            mensajeError.textContent = 'El nombre de usuario o correo electrónico ya está en uso.';
        } else if (data.status === 'unique') {
            form.submit(); // Enviar el formulario si no hay errores
        }
    })
    .catch(error => {
        mensajeError.textContent = 'Ocurrió un error al validar los datos.';
    });
    });
});
  