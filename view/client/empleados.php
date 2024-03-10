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
                    <!--Inicio de la barrita de navegacion-->
                    <div class="navbar bg-base-300 rounded-box mb-5">
                        <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarEmpleado()"> + Añadir empleado</button>
                        </div>
                        <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 dias</button>
                        </div>
                        <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="">Filtrar por</button>
                        </div>
                        <div class="flex justify-end flex-1 px-2">
                            <div class="flex items-stretch">
                                <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                                <div class="dropdown dropdown-end">
                                    <div tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn">Config</div>
                                    <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                        <li><a>Item 1</a></li>
                                        <li><a>Item 2</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="table bg-gray-700">
                            <!-- head -->
                            <thead>
                                <tr class="font-semibold text-base">
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
                                    <tr class="text-base">
                                        <!--ID del empleado-->
                                        <td><?php echo $row['pk_employee'] ?></td>
                                        <!--Foto del empleado-->
                                        <td>
                                            <div class="avatar online">
                                                <div class="w-16 rounded-full">
                                                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                </div>
                                            </div>
                                        </td>
                                        <!--Nombre del empleado-->
                                        <td>
                                            <?php echo $row['employee_name'] ?>
                                            <br />
                                            <!--Rol del empleado-->
                                            <span class="p-3 badge badge-ghost badge-sm"><?php echo $row['rol_name'] ?></span>
                                        </td>
                                        <!--Apellidos del empleado-->
                                        <td><?php echo $row['employee_lastNameP'] . ' ' . $row['employee_lastNameM'] ?></td>
                                        <!--Ver detalles del empleado-->
                                        <td>
                                            <button class="btn btn-outline btn-success btn-xs" onclick="actualizarEmpleado(
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