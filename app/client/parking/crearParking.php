<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}
session_start();
//Incluimos la clase Espacios para crear el objeto.
include(PROJECT_ROOT.'/data/class/parking.php');

// Procesar el formulario para agregar un nuevo estacionamiento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['location']) && isset($_POST['capacity'])) {
    $parking = $_POST['parking'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];

    $parkingHandler= new Parking();
    $parkingHandler -> parking_number = $parking;
    $parkingHandler->setFKclient($_SESSION['client_id']); //Setteamos el client_id.
    // Agregar el nuevo estacionamiento
    if ($parkingHandler->addParking($location, $capacity)) {
        echo "Estacionamiento agregado correctamente";
        header('Location: '.PROJECT_URL_ROOT.'view/client/parking.php');
    } else {
        echo "Error al agregar estacionamiento";
    }
}
?>
