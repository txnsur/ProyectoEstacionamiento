<?php
// Si no se ha definido PROJECT_ROOT, lo definimos
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

// Incluimos las clases necesarias
include(PROJECT_ROOT . '/data/class/visit.php');
include(PROJECT_ROOT . '/data/class/accesscard.php');

session_start();

// Establecemos los valores utilizando métodos setters de la clase Visit
$visit = new Visit();
$visit->setCompany($_POST['company']);
$visit->setReason($_POST['reason']);
$visit->setName($_POST['visit_name']);
$visit->setLastName($_POST['visit_lastName']);
$visit->setFkClient($_SESSION['client_id']);

// Insertamos la visita y obtenemos el ID de la fila insertada
$id = $visit->setVisit(); // Insertamos la visita y obtenemos el ID de la fila insertada

if ($id > 0) {
    // Generamos el código QR y las fechas de la tarjeta de acceso
    function generateRandomCode($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[mt_rand(0, $max)];
        }

        return $code;
    }

    $QR_code = generateRandomCode();
    $creation_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($creation_date)));

    // Obtener el último ID de visita insertado
    $conexion = new Conexion(); // Reemplaza 'Conexion()' con tu clase de conexión real
    $conexion->connect(); // Realiza la conexión a tu base de datos

    $query_last_visit = "SELECT MAX(pk_visit) AS last_visit_id FROM Visit";
    $result_last_visit = $conexion->execquery($query_last_visit);

    if ($result_last_visit && mysqli_num_rows($result_last_visit) > 0) {
        $row_last_visit = mysqli_fetch_assoc($result_last_visit);
        $last_visit_id = $row_last_visit['last_visit_id'];

        $access_card = new AccessCard();
        $access_card->setQRCode($QR_code);
        $access_card->setCreationDate($creation_date);
        $access_card->setEndDate($end_date);
        $access_card->setCardType('Visitante'); // Asignamos el tipo de tarjeta aquí
        $access_card->setFKVisit($last_visit_id); // Asignamos el ID de la visita obtenido previamente
        
        $insert_success = $access_card->insertAccessCardForVisit($QR_code, $creation_date, $end_date, 'Visitante', $last_visit_id);

        if ($insert_success) {
            // Redirigir a la página de gestión de visitantes
            header('Location: ' . PROJECT_URL_ROOT . 'view/client/visitantes.php');
            exit();
        } else {
            echo 'No se pudo generar la tarjeta de acceso para el visitante.';
        }
    } else {
        echo 'No se pudo obtener el último ID de visita insertado.';
    }
} else {
    echo 'No se ha podido registrar la visita.';
}
?>
