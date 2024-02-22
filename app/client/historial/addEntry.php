<?php 
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}
include_once(PROJECT_ROOT . 'app/session.php');
include(PROJECT_ROOT."view/navBar.php");
include(PROJECT_ROOT . '/data/class/entryExit.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['QR_code'])) {
    $QR_code = $_POST['QR_code'];
    $selectedParking = $_POST['selectedParking'];

    //Creamos un objeto.
    $carentry = new carentry();
    $resultadoEntrada = $carentry->registrarEntradaVehiculo($QR_code, $selectedParking);

    if ($resultadoEntrada) {
        echo "<script>setTimeout(function(){ window.location.href = '".PROJECT_URL_ROOT."view/client/historial/carResultado.php'; }, 0);</script>";
    }
}
?>