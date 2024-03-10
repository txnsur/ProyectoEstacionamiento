<!--===============MODAL PARA AGREGAR EMPLEADO========================================-->
<dialog id="agregarEmpleadoModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Añadir empleado</h3>
        <div class="modal-action">
            <form method="post" action="../../app/client/empleados/addEmployee.php">
                <div class="avatar flex justify-center items-center relative">
                    <input type="file" id="imagenEmpleado" class="hidden" accept="image/*" onchange="mostrarImagen(this)">
                    <label for="imagenEmpleado" class="cursor-pointer">
                        <div class="mask mask-squircle w-15 h-15 bg-white text-black relative">
                            <img id="previewImagen" class="w-full h-full object-cover" src="" alt="Foto del empleado" />
                        </div>
                    </label>
                </div>
                <div class="m-2">
                    <label for="nombreEmpleado">Nombre del empleado</label>
                    <input type="text" name="nombreEmpleado"><br>
                </div>
                <div class="m-2">
                    <label for="nombreEmpleado">Apellido paterno del empleado</label>
                    <input type="text" name="apPaternoEmpleado"><br>
                </div>
                <div class="m-2">
                    <label for="nombreEmpleado">Apellido materno del empleado</label>
                    <input type="text" name="apMaternoEmpleado"><br>
                </div>
                <div>
                    <label for="">Rol</label>
                    <select name="rolEmpleado">;
                        <option value="1">Gerente de Planta</option>;
                        <option value="2">Gerente de produccion</option>;
                        <option value="3">Gerente de recursos</option>;
                        <option value="4">Secretaria</option>;
                        <option value="5">Supervisor</option>;
                        <option value="6">Empleado</option>;
                        <option value="7">Administrador</option>;
                        <option value="8">Recursos HUmanos</option>;
                        <option value="9">Finanzas</option>;
                        <option value="10">Mantenimiento</option>;
                        <option value="11">Seguridad</option>;
                        <option value="12">Maquinado</option>;
                    </select>
                </div>
                <div class="flex justify-end">
                    <input type="submit" value="Enviar" class="cursor-pointer mt-5">
                </div>
            </form>
        </div>
    </div>
</dialog>
<!--==============================SCRIPTS PARA AGREGAR EMPLEAODS================================-->
<script>
    function cambiarColor() {
        var empleadosLink = document.getElementById("empleadosLink");
        empleadosLink.classList.add("text-pink-500");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();

    function agregarEmpleado() {
        agregarEmpleadoModal.showModal();
    }

    function mostrarImagen(input) {
        var preview = document.getElementById('previewImagen');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>
<!--==============================TERMINA EL MODAL PARA AGREGAR EMPLEAODS================================-->

<!--============================== MODAL PARA ACTUALIZAR EMPLEAODS=======================================-->
<dialog id="actualizarEmpleadoModal" class="modal bg-black-300 text-white">
    <div class="modal-box">

    </div>
</dialog>

<script>
    function actualizarEmpleado(id, nombre, apPaterno, apMaterno, rol) {
        var modal = document.getElementById('actualizarEmpleadoModal');
        var modalContent = modal.querySelector('.modal-box');

        modalContent.innerHTML = `
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Actualizar empleado</h3>
        <div class="modal-action">
            <form method="post" action="../../app/client/empleados/editEmployee.php">
                <div>
                <input type="number" name="idEmpleado" value="${id}">
                </div>
                <div class="avatar flex justify-center items-center relative">
                    <input type="file" id="imagenEmpleado" class="hidden" accept="image/*" onchange="mostrarImagen(this)">
                    <label for="imagenEmpleado" class="cursor-pointer">
                        <div class="mask mask-squircle w-15 h-15 bg-white text-black relative">
                            <img id="previewImagen" class="w-full h-full object-cover" src="" alt="Foto del empleado" />
                        </div>
                    </label>
                </div>
                <div class="m-2">
                    <label for="nombreEmpleado">Nombre del empleado</label>
                    <input type="text" name="nombreEmpleado" value="${nombre}"><br>
                </div>
                <div class="m-2">
                    <label for="nombreEmpleado">Apellido paterno del empleado</label>
                    <input type="text" name="apPaternoEmpleado" value="${apPaterno}"><br>
                </div>
                <div class="m-2">
                    <label for="nombreEmpleado">Apellido materno del empleado</label>
                    <input type="text" name="apMaternoEmpleado" value="${apMaterno}"><br>
                </div>
                <div>
                    <label for="rolEmpleado">Rol</label>
                    <select name="rolEmpleado">
                        <option value="1" ${rol === 'Gerente de Planta' ? 'selected' : ''}>Gerente de Planta</option>
                        <option value="2" ${rol === 'Gerente de produccion' ? 'selected' : ''}>Gerente de produccion</option>
                        <option value="3" ${rol === 'Gerente de recursos' ? 'selected' : ''}>Gerente de recursos</option>
                        <option value="4" ${rol === 'Secretaria' ? 'selected' : ''}>Secretaria</option>
                        <option value="5" ${rol === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                        <option value="6" ${rol === 'Empleado' ? 'selected' : ''}>Empleado</option>
                        <option value="7" ${rol === 'Administrador' ? 'selected' : ''}>Administrador</option>
                        <option value="8" ${rol === 'Recursos HUmanos' ? 'selected' : ''}>Recursos HUmanos</option>
                        <option value="9" ${rol === 'Finanzas' ? 'selected' : ''}>Finanzas</option>
                        <option value="10" ${rol === 'Mantenimiento' ? 'selected' : ''}>Mantenimiento</option>
                        <option value="11" ${rol === 'Seguridad' ? 'selected' : ''}>Seguridad</option>
                        <option value="12" ${rol === 'Maquinado' ? 'selected' : ''}>Maquinado</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <input type="submit" value="Enviar" class="cursor-pointer mt-5">
                </div>
            </form>
        </div>`;

        actualizarEmpleadoModal.showModal();
    }
</script>