<?php 
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}
include_once(PROJECT_ROOT . 'app/session.php');
include(PROJECT_ROOT."view/navBar.php");
include(PROJECT_ROOT.'/data/class/entryExit.php');

$carentry = new carentry();
$resultadoEntrada = $carentry->registrarSalidaVehiculo($_POST['entry_id']);

echo "<p>Resultado de la entrada:</p> $resultadoEntrada";