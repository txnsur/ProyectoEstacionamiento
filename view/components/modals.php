<!--Modales-->
<dialog id="my_modal_1" class="modal bg-black-300 text-white">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Detalles de compra</h3>
                <p class="py-6">Ponemos todos los detalles para confirmar la compra</p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn" onclick="confirmarCompra()">Confirmar compra</button>                    </form>
                </div>
            </div>
        </dialog>

        <dialog id="my_modal_2" class="modal bg-black-300 text-white">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Confirmando compra...</h3>                
            </div>
        </dialog>

        <dialog id="my_modal_3" class="modal bg-black-300 text-white">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Compra exitosa!</h3>                
            </div>
        </dialog>

        <dialog id="iniciar" class="modal bg-black-300 text-white">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Verificando...</h3>                
            </div>
        </dialog>

        <dialog id="cuentaEncontrada" class="modal bg-black-300 text-white">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Cuenta encontrada!</h3>                
            </div>
        </dialog>

        <dialog id="logout" class="modal bg-black-300 text-white">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Cerrando sesion...</h3>                
            </div>
        </dialog>

        <!--Efecto de esperar 2 segundos-->
        <script>
            function confirmarCompra() {
                // Agregar un efecto de espera de 2 segundos antes de redirigir
                my_modal_2.showModal();

                setTimeout(function() {
                    my_modal_3.showModal();
                }, 2000); // 2000 milisegundos = 2 segundos

                setTimeout(function() {
                    window.location.href = "login.php";
                }, 5000); // 2000 milisegundos = 2 segundos
            }

            function iniciarSesion() {
                iniciar.showModal();

                setTimeout(function() {
                    cuentaEncontrada.showModal();
                }, 2000); // 2000 milisegundos = 2 segundos

                setTimeout(function() {
                    window.location.href = "client/dashboard.php";
                }, 3000); // 2000 milisegundos = 2 segundos
            }

            function  cerrarSesion(){
                logout.showModal();

                setTimeout(function() {
                    window.location.href = "../../index.php";
                }, 3000); // 2000 milisegundos = 2 segundos
            }
        </script>