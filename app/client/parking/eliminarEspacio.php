<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

//Incluimos la clase Espacios para crear el objeto.
include(PROJECT_ROOT.'/data/class/Espacios.php');

//Establecemos los valores de los setters.
$deleteSpace = new Espacios();
$eliminacionExitosa = $deleteSpace->eliminarEspacio($_GET['id']);

if ($eliminacionExitosa > 0) {
    echo "Espacio eliminado exitosamente.";
    header('Location: '.PROJECT_URL_ROOT.'view/client/parking/viewespacios.php');
} else {
    echo "Error al eliminar el espacio.";
}

?>
