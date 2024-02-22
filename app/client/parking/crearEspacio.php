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

    $space_number = $_POST['spaces_number'];

    $myEspacios = new Espacios();
    $myEspacios->setFkClient($_SESSION['client_id']); 
    $myEspacios->setFk_parking($_SESSION['pk_parking']); 

    $limite = $myEspacios->getCapacidad(); //Obtenemos el limite
    $espaciosActuales = $myEspacios->getEspaciosActuales(); //Creamos otro metodo que obtenga los espacios actuales.

    //Validamos la capacidad del parking con los espacios actuales.
    if ($espaciosActuales < $limite) {
    $creacionExitosa = $myEspacios->crearEspacio($space_number);
    echo "<script>setTimeout(function(){ window.location.href = '".PROJECT_URL_ROOT."view/client/parking/viewespacios.php'; }, 0);</script>";
    } else {
        echo 'no se puede crear un espacio. Ya has llegado al limite';
        echo "<script>setTimeout(function(){ window.location.href = '".PROJECT_URL_ROOT."view/client/parking/viewespacios.php'; }, 2000);</script>";
    }
?>