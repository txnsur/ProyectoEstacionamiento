<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

//Incluimos la clase Espacios para crear el objeto.
include(PROJECT_ROOT.'/data/class/parking.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['parking_id']) && isset($_POST['location'])) {
    $parkingID = $_POST['parking_id'];
    $parking_number = $_POST['parking'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];
    if($_POST['status'] == 1) {
        $status = 1;
    } else {
        $status = 2;
    }
    // Crear una instancia de la clase Parking
    $parkingHandler = new Parking();
    $parkingHandler -> parking_number = $parking_number;
    $parkingHandler -> parking_capacity = $capacity;
    
    // Lógica para actualizar el estacionamiento
    if ($parkingHandler->updateParking($parkingID, $location, $status)) {
        echo "Estacionamiento actualizado correctamente";
        header('Location: '.PROJECT_URL_ROOT.'view/client/parking.php');
    } else {
        echo "Error al actualizar estacionamiento";
        header('Location: '.PROJECT_URL_ROOT.'view/client/parking.php');
    }
}

// if (isset($_GET['id'])) {
//     $parkingID = $_GET['id'];
//     // Crear una instancia de la clase Parking
//     $parkingHandler = new Parking();

//     // Obtener detalles del estacionamiento usando el método getParkingDetails
//     $parkingDetails = $parkingHandler->getParkingDetails($parkingID);

//     if (!$parkingDetails) {
//         // Redirige a alguna página de manejo de errores si no se pueden obtener detalles.
//         header("Location: error_page.php");
//         exit();
//     }
// } else {
//     // Redirige a alguna página de manejo de errores si no se proporciona un ID.
//     header("Location: error_page.php");
//     exit();
// }
?>