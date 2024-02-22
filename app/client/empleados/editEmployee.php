<?php
//Definimos nuestro carpeta principal.
define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

//Incluimos la clase empleado para crear el objeto.
include(PROJECT_ROOT.'/data/class/employee.php');

//Establecemos los valores de los setters.
$employee = new Employee();
$employee -> setID($_POST['pk_employee']);
$employee -> setName($_POST["name"]);
$employee -> setLastNameP($_POST["paterno"]);
$employee -> setLastNameM($_POST["materno"]);
$employee -> setRol($_POST["rol"]);

//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $employee -> updateEmployee();

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if($id > 0) {
header('Location: '.PROJECT_URL_ROOT.'view/client/empleados.php');
}
?>