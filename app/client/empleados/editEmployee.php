<?php
//Incluimos la clase empleado para crear el objeto.
include(__DIR__.'/../../../data/class/employee.php');

//Establecemos los valores de los setters.
$employee = new Employee();
$employee -> setID($_POST['idEmpleado']);
$employee -> setName($_POST["nombreEmpleado"]);
$employee -> setLastNameP($_POST["apPaternoEmpleado"]);
$employee -> setLastNameM($_POST["apMaternoEmpleado"]);
$employee -> setRol($_POST["rolEmpleado"]);

//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $employee -> updateEmployee();

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if($id > 0) {
header('Location: ../../../view/client/empleados.php');
}
