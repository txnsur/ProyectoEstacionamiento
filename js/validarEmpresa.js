//Declaremos nuestra varia
const contenedor = document.querySelector(".contenedorPrincipal");
const body = document.querySelector(".body-background");

//Añadimos un evento que se ejecute cuando el cursor este sobre abrirFormulario
document.querySelector(".abrirFormulario").addEventListener("click", function() {
    document.querySelector(".contenedorEmpresa").classList.add("visible");
    contenedor.classList.add("moverIzquierda");
});

//Añadimos un evento que se ejecute cuando el cursor no este sobre abrirFormulario.
body.addEventListener("click", function() {
document.querySelector(".contenedorEmpresa").classList.remove("visible");
contenedor.classList.remove("moverIzquierda");
});

// document.getElementById("formUsuario").addEventListener("submit", function(evento) {
//     evento.preventDefault(); // Solo si no quieres enviar el formulario inmediatamente.
//     const contenedorEmpresa = document.querySelector(".contenedorEmpresa");
//     contenedorEmpresa.classList.add("visible"); // Añade la clase que hace el contenedor visible.
//     contenedor.classList.add("moverIzquierda");
// });

document.addEventListener('DOMContentLoaded', (event) => {
    // Seleccionar todos los campos requeridos dentro del formulario
    const requiredFields = document.querySelectorAll('.contenedorEmpresa [required]');
  
    // Función para mostrar el contenedorEmpresa
    const showContenedorEmpresa = () => {
      const contenedorEmpresa = document.querySelector(".contenedorEmpresa");
      contenedorEmpresa.classList.add("visible"); // Añade la clase que hace el contenedor visible.
      contenedor.classList.add("moverIzquierda"); // Mueve el contenedor
    };
  
    // Añadir un manejador de eventos para el evento 'invalid' en cada campo requerido
    requiredFields.forEach(field => {
      field.addEventListener('invalid', showContenedorEmpresa);
    });
  });