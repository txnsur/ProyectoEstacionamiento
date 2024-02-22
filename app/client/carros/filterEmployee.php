<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

//Incluimos la clase empleado para crear el objeto.
include(PROJECT_ROOT.'/data/class/employee.php');

//Filtrar empleados.
$employee = new Employee();
$employee->setFKclient($_SESSION['client_id']);
$employeeList = $employee->getEmployee();

//Obtener la marca.
$car = new Car();
$marca = $car->getMarca(); 

//Obtener los modelos
$modelo = $car->getModel();

//Obtener los colores.
$color = $car->getModelColor();
?>