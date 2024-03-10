<!--Incluimos el navbar-->
<?php include_once "navbar.php"; ?>
<?php include_once "modals/empleados.php"; ?>

<?php
//Agregamos la clase del empleados.
include_once(__DIR__ . "/../../data/class/employee.php");

//Creamos un objeto que sea de nuestro cliente para obtener todos sus valores.
$employee = new Employee();

//Le decimos que haga el display de los empleados que coincidan con la pk del cliente.
$employee->setFKclient($_SESSION['client_id']);
$employees = $employee->getEmployee();
?>
<?php if ($employees != "error") { ?>
    <div>
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <section class=" w-full">
                        <div class="">
                            <button class="text-white" onclick="agregarEmpleado()"> + Añadir empleado</button>
                        </div>
                    </section>
                    <div class="overflow-x-auto">
                        <table class="table bg-gray-600">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <?php while ($row = mysqli_fetch_assoc($employees)) { ?>
                                    <tr>
                                        <!--ID del empleado-->
                                        <td><?php echo $row['pk_employee'] ?></td>
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
                                        <!--Nombre del empleado-->
                                        <td>
                                            <?php echo $row['employee_name'] ?>
                                            <br />
                                            <!--Rol del empleado-->
                                            <span class="badge badge-ghost badge-sm"><?php echo $row['rol_name'] ?></span>
                                        </td>
                                        <!--Apellidos del empleado-->
                                        <td><?php echo $row['employee_lastNameP'] . ' ' . $row['employee_lastNameM'] ?></td>
                                        <!--Ver detalles del empleado-->
                                        <td>
                                            <button class="btn btn-ghost btn-xs" onclick="actualizarEmpleado(
                                                '<?php echo $row['pk_employee']; ?>',
                                                '<?php echo $row['employee_name']; ?>',
                                                '<?php echo $row['employee_lastNameP']; ?>',
                                                '<?php echo $row['employee_lastNameM']; ?>',
                                                '<?php echo $row['rol_name']; ?>'
                                            )">Detalles</button>
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