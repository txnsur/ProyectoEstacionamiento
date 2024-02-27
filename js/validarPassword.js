function validarPassword() {
    const password = document.getElementById("password");
    const mensajeError = document.getElementById("mensajeError");

    if (!password.checkValidity()) {
        if (password.validity.valueMissing) {
            mensajeError.textContent = "La contraseña es requerida.";
        } else if (password.validity.tooShort) {
            mensajeError.textContent = "La contraseña debe tener al menos 8 caracteres.";
        } 
        else if (password.validity.patternMismatch) {
            mensajeError.textContent = "La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número.";
        } 
    } else {
        mensajeError.textContent = "";
    }
}