<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

//Incluimos la clase empleado para crear el objeto.
include(PROJECT_ROOT.'/data/class/car.php');

session_start();
//Establecemos los valores de los setters.
$car = new Car();
$car -> id = $_GET['id'];
$car -> fk_status = 2;

//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $car -> updateCar();

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if($id > 0) {
    header('Location: '.PROJECT_URL_ROOT.'view/client/carros.php');
} else {
    echo 'no ha funcionado el registro del empleado';
}
?>