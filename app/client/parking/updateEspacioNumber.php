<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}
session_start();
//Incluimos la clase Espacios para crear el objeto.
include(PROJECT_ROOT.'/data/class/Espacios.php');

//Establecemos los valores de los setters.
$space = new Espacios();
$space->setSpacesNumber($_POST['space_number']);

$updateResultado = $space->updateEspacioNumber($_GET['space_id']);

if ($updateResultado > 0) {
    echo "Espacio actualizado exitosamente.";
    header('Location: '.PROJECT_URL_ROOT.'view/client/parking/viewespacios.php?idParking='.$_SESSION['pk_parking'].'');
} else {
    echo "Error al eliminar el espacio.";
}

?>
