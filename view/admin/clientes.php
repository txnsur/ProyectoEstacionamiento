<!--Incluimos el navbar-->
<?php include_once "navbarAdmin.php"; ?>
<?php include_once "modals/clientes.php"; ?>

<?php
//Agregamos la clase del empleados.
include_once(__DIR__ . "/../../data/class/client.php");

//Creamos un objeto que sea de nuestro cliente para obtener todos sus valores.
$client = new Client();
$clientes = $client->getAllClients();
?>
<?php if ($clientes != "error") { ?>

    <div>
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <section class=" w-full">
                        <div class="">
                            <button class="text-white" onclick="agregarEmpleado()"> + Añadir cliente</button>
                        </div>
                    </section>
                    <div class="overflow-x-auto">
                        <table class="table bg-gray-600">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <?php while ($row = mysqli_fetch_assoc($clientes)) { ?>
                                    <tr>
                                        <!--ID del empleado-->
                                        <td><?php echo $row['pk_client'] ?></td>
                                        <!--Foto del empleado-->
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="mask mask-squircle w-12 h-12">
                                                        <img src="/tailwind-css-component-profile-2@56w.png" alt="Avatar Tailwind CSS Component" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!--Nombre de la empresa-->
                                        <td>
                                            <?php echo $row['client_name'] ?>
                                            <br />
                                            <!--Email de la empresa-->
                                            <span class="badge badge-ghost badge-sm"><?php echo $row['client_email'] ?></span>
                                        </td>
                                        <!--Ubicacion de la empresa-->
                                        <td><?php echo $row['client_address'] ?></td>
                                        <!--Ver detalles de la empresa-->
                                        <td>
                                            <button class="btn btn-ghost btn-xs" onclick="actualizarEmpresa()">Detalles</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

</div>
</body>