<?php
//Definimos nuestro carpeta principal.
define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

//Incluimos la clase cliente y usuario para crear el objeto.
include(PROJECT_ROOT.'/data/class/user.php');
include(PROJECT_ROOT.'/data/class/client.php');

//Establecemos los valores de los setters de la clase User.
$User = new User();
$User -> setNickname($_POST["username"]);
$User -> setEmail($_POST["emailUsuario"]);
$User -> setPassword($_POST["password"]);
//Llamamos el metodo y nos retorna el valor de un id de la fila insertada
// que usaremos como foreign key.

$resultado = true;

try { //Intentamos ejecutar la inserccion.
    $fk_user = $User -> setUser();
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
}

$id = 0; //Para que no pete la siguiente.

if ($resultado) { //Validamos si se inserto el usuario.
//Establecemos los valores de los setters de la clase Cliente.
$Client = new Client();
$Client -> setName($_POST["empresa"]);
$Client -> setEmail($_POST["email"]);
$Client -> setAddress($_POST["direccion"]);
$Client -> setCountry($_POST["pais"]);
$Client -> setCity($_POST["ciudad"]);
$Client -> setState($_POST["estado"]);
$Client -> setZipCode($_POST["postal"]);
$Client -> setTel($_POST["tel"]);
$Client -> setFK_user($fk_user);

//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $Client -> setClient();
}

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if($id > 0) {
header('Location: '.PROJECT_URL_ROOT.'view/login.html');
} else {
    echo "Error en el registro";
}
?>