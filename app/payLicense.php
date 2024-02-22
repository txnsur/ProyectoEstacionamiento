<?php 
    //Definimos nuestro carpeta principal e incluimos la clase usuario para crear el objeto.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

    //Incluimos la clase.
    include(PROJECT_ROOT."/data/class/payment.php");
    include(PROJECT_ROOT."/data/class/licenses.php");
    include(PROJECT_ROOT."/data/class/user.php");

    //Simulamos que ha realizado el pago.
    session_start();

    //Establecemos los valores de los setters de la clase payment.
    $payment = new Payment();
    $payment -> setAmount($_POST["amount"]);
    $payment -> setDescription($_POST["description"]);
    $payment -> setDuration($_POST['duration']);
    $payment -> setClient($_SESSION['client_id']);

    //Realizamos el pago y almacenamos el id de la inserccion realizada.
    $id = $payment -> setPayment();
    
   //Validamos que se haya completado exitosamente el pago.
   if($id > 0) {
    //Creamos nuestra clase de licencias
    $license = new Licenses();  
    $license -> setDuration($_POST['duration']);
    $license -> setPayment($id);

    $accessCode = $license -> setLicenses(); //Obtenemos el accessCode

    if ($accessCode > 1){
        $user = new User();
        $user -> setID($_SESSION['user_id']); //Setteamos el ID de nuestro usuario.
        $user->updateAccessCode($accessCode); //Le mandamos el mismo code de la membresia al usuario.
        //Redireccionamos
        header('Location: '.PROJECT_URL_ROOT.'view/confirmedPay.php');
    } else {
        echo 'Ha ocurrido un error a la hora de registrar la licencia';
    }
   } else {
    echo 'Ha ocurrido un error a la hora de realizar el pago';
   }
?>