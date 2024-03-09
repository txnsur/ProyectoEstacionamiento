<?php
// Extraemos todos las variables de SESSION.
session_start();
echo $_SESSION['usuarioNuevo'] . "<br>";
echo $_SESSION['correoNuevo'] . "<br>";
echo $_SESSION['contraNueva'] . "<br>";
echo $_SESSION['nombreEmpresa'] . "<br>";
echo $_SESSION['emailEmpresa'] . "<br>";
echo $_SESSION['direccionEmpresa'] . "<br>";
echo $_SESSION['paisEmpresa'] . "<br>";
echo $_SESSION['estadoEmpresa'] . "<br>";
echo $_SESSION['ciudadEmpresa'] . "<br>";
echo $_SESSION['codigoEmpresa'] . "<br>";
echo $_SESSION['telEmpresa'] . "<br>";
echo $_POST['amount'] . "<br>";
echo $_POST['description'] . "<br>";
echo $_POST['duration'] . "<br>";

// Incluimos nuestras clases.
include('../data/class/user.php'); // Usuario.
include('../data/class/client.php'); // Empresa.
include("../data/class/payment.php"); // Registrar pago.
include("../data/class/licenses.php");

// +==================================================================+
// Establecemos los valores de los setters de la clase 'USER'.
$User = new User();
$User->setNickname($_SESSION["usuarioNuevo"]);
$User->setEmail($_SESSION["correoNuevo"]);
$User->setPassword($_SESSION["contraNueva"]);

$resultado = true;

try { // Intentamos ejecutar la inserccion.
    $fk_user = $User->setUser(); // Me retorna el ID insertado.
} catch (mysqli_sql_exception $e) { //En caso de ocurrir una entrada duplicada como nickname o password.
    // Si hay un error con la inserción, verifica si es por un valor duplicado
    $resultado = false;
    if ($e->getCode() === 1062) {
        // Enviar una respuesta que tu JavaScript pueda entender y manejar
        echo 'duplicate';
    } else {
        // Si es un error diferente, también deberías manejarlo
        echo 'Error con la inserccion del usuario';
    }
} // Fin de las inserciones de la clase 'USER'.
// +====================================================================+

// +====================================================================+
$fk_client = 0; // Establecemos el ID del 'CLIENTE'.

try {
    if ($resultado) { // Validamos si se inserto el usuario.
        // Establecemos los valores de los setters de la clase Cliente.
        $Client = new Client();
        $Client->setName($_SESSION["nombreEmpresa"]);
        $Client->setEmail($_SESSION["emailEmpresa"]);
        $Client->setAddress($_SESSION["direccionEmpresa"]);
        $Client->setCountry($_SESSION["paisEmpresa"]);
        $Client->setCity($_SESSION["ciudadEmpresa"]);
        $Client->setState($_SESSION["estadoEmpresa"]);
        $Client->setZipCode($_SESSION["codigoEmpresa"]);
        $Client->setTel($_SESSION["telEmpresa"]);
        $Client->setFK_user($fk_user);

        //Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
        $fk_client = $Client->setClient();
    }  // Fin de la inserciones del 'CLIENTE'.
} catch (mysqli_sql_exception $e) {
    // Si hay un error con la inserción, verifica si es por un valor duplicado
    $resultado = false;
    echo "Error con la insercion de la empresa.";
}
// +=====================================================================+

// +======================================================================+
// Establecemos los valores de los setters de la clase payment.
try {
    if ($resultado) {
        $payment = new Payment();
        $payment->setAmount($_POST["amount"]);
        $payment->setDescription($_POST["description"]);
        $payment->setDuration($_POST['duration']);
        $payment->setClient($fk_client);
        // Realizamos el pago y almacenamos el id de la inserccion realizada.
        $idPago = $payment->setPayment();
    }
} catch (mysqli_sql_exception $e) {
    $resultado = false;
    echo "Error con la insercion del pago.";
}
// +=======================================================================+ 

// +=======================================================================+
//Validamos que se haya completado exitosamente el pago.
try {
    if ($resultado) {
        //Creamos nuestra clase de licencias
        $license = new Licenses();
        $license->setDuration($_POST['duration']);
        $license->setPayment($idPago);
        $accessCode = $license->setLicenses(); //Obtenemos el accessCode

        if ($accessCode > 1) {
            $User->setID($fk_user); //Setteamos el ID de nuestro usuario.
            $User->updateAccessCode($accessCode); //Le mandamos el mismo code de la membresia al usuario.
            //Redireccionamos
            header('Location: ../view/login.php');
        } else {
            echo 'Ha ocurrido un error a la hora de registrar la licencia';
        }
    }
} catch (mysqli_sql_exception $e) {
    $resultado = false;

    echo "Error con el registor de la licencia";
}
