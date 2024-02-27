function validarFormulario() {
    // Obtiene los valores de los campos
    var email = document.getElementsByName("email")[0].value;
  
    // Expresión regular para validar el formato del correo electrónico
    var emailRegex = /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/;
  
    // Validación del correo electrónico
    if (!emailRegex.test(email)) {
      // Muestra un mensaje de error
      document.getElementById("errorCorreo").innerText = "Por favor, ingresa una dirección de correo electrónico válida.";
      return false; // Evita que el formulario se envíe
    }
  
    // Si todo está bien, devuelve true para permitir que el formulario se envíe
    return true;
  }