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
            mensajeError.textContent = "La contraseña debe contener al 8 caracteres, una letra mayúscula, una letra minúscula y un número.";
        }
    } else {
        mensajeError.textContent = "";
    }
}
function mostrarPassword() {
    const password = document.getElementById("password");
    const toggleButton = document.getElementById("toggleVisibility");

    if (password.type === "password") {
        password.type = "text";
        toggleButton.textContent = "Ocultar contraseña";
    } else {
        password.type = "password";
        toggleButton.textContent = "Mostrar contraseña";
    }
}

// Asociar la función validarPassword al evento de cambio en el campo de contraseña
document.getElementById("password").addEventListener("input", validarPassword);