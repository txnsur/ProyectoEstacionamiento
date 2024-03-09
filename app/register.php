<?php
// Extraemos todos las variables de SESSION.
session_start();
echo $_SESSION['usuarioNuevo'];
echo $_SESSION['correoNuevo'];
echo $_SESSION['contraNueva'];
echo $_SESSION['nombreEmpresa'];
echo $_SESSION['emailEmpresa'];
echo $_SESSION['direccionEmpresa'];
echo $_SESSION['paisEmpresa'];
echo $_SESSION['estadoEmpresa'];
echo $_SESSION['ciudadEmpresa'];
echo $_SESSION['codigoEmpresa'];
echo $_SESSION['telEmpresa'];

//Incluimos nuestras clases.
include('../data/class/user.php'); // Usuario.
include('../data/class/client.php'); // Empresa.
include("../data/class/payment.php"); // Registrar pago.
include("../data/class/licenses.php");

// Efra eres un pendejo

// +==================================================================+
// Establecemos los valores de los setters de la clase 'USER'.
$User = new User();
$User->setNickname($_POST["usuarioNuevo"]);
$User->setEmail($_POST["correoNuevo"]);
$User->setPassword($_POST["contraNueva"]);

$resultado = true;

try { // Intentamos ejecutar la inserccion.
    $fk_user = $User->setUser(); // Me retorna el ID insertado.
    $resultado = true;
} catch (mysqli_sql_exception $e) { //En caso de ocurrir una entrada duplicada como nickname o password.
    // Si hay un error con la inserción, verifica si es por un valor duplicado
    $resultado = false;
    if ($e->getCode() === 1062) {
        // Enviar una respuesta que tu JavaScript pueda entender y manejar
        echo 'duplicate ';
    } else {
        // Si es un error diferente, también deberías manejarlo
        echo 'error';
    }
} // Fin de las inserciones de la clase 'USER'.
// +====================================================================+

// +====================================================================+
$fk_client = 0; // Establecemos el ID del 'CLIENTE'.

if ($resultado) { // Validamos si se inserto el usuario.
    // Establecemos los valores de los setters de la clase Cliente.
    $Client = new Client();
    $Client->setName($_POST["empresa"]);
    $Client->setEmail($_POST["email"]);
    $Client->setAddress($_POST["direccion"]);
    $Client->setCountry($_POST["pais"]);
    $Client->setCity($_POST["ciudad"]);
    $Client->setState($_POST["estado"]);
    $Client->setZipCode($_POST["postal"]);
    $Client->setTel($_POST["tel"]);
    $Client->setFK_user($fk_user);

    //Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
    $fk_client = $Client->setClient();
} else {
} // Fin de la inserciones del 'CLIENTE'.
// +=====================================================================+

// +======================================================================+
// Establecemos los valores de los setters de la clase payment.
$payment = new Payment();
$payment->setAmount($_POST["amount"]);
$payment->setDescription($_POST["description"]);
$payment->setDuration($_POST['duration']);
$payment->setClient($fk_client);

// Realizamos el pago y almacenamos el id de la inserccion realizada.
$id = $payment->setPayment();

//Validamos que se haya completado exitosamente el pago.
if ($id > 0) {
    //Creamos nuestra clase de licencias
    $license = new Licenses();
    $license->setDuration($_POST['duration']);
    $license->setPayment($id);
}

//     $accessCode = $license -> setLicenses(); //Obtenemos el accessCode

//     if ($accessCode > 1){
//         $user = new User();
//         $user -> setID($_SESSION['user_id']); //Setteamos el ID de nuestro usuario.
//         $user->updateAccessCode($accessCode); //Le mandamos el mismo code de la membresia al usuario.
//         //Redireccionamos
//         header('Location: '.PROJECT_URL_ROOT.'view/confirmedPay.php');
//     } else {
//         echo 'Ha ocurrido un error a la hora de registrar la licencia';
//     }
//    } else {
//     echo 'Ha ocurrido un error a la hora de realizar el pago';
//    }
