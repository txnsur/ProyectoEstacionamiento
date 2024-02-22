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
$car -> matricula = $_POST["matricula"];
$car -> model_year = $_POST["model_year"];
$car -> fk_employee = $_POST["employee"];
$car -> fk_model = $_POST["modelo"];
$car -> fk_color = $_POST["color"];
$car -> fk_status = 1;
$car -> fk_client = $_SESSION["client_id"];


//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $car -> setCarInformation();

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if($id > 0) {
    header('Location: '.PROJECT_URL_ROOT.'view/client/carros.php');
} else {
    echo 'no ha funcionado el registro del empleado';
}
?>