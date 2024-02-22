<?php
//Definimos nuestro carpeta principal.
define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

//Incluimos la clase cliente para crear el objeto.
include(PROJECT_ROOT.'/data/class/client.php');

//Establecemos los valores de los setters.
$Client = new Client();
$Client -> setID($_POST['pk_client']);
$Client -> setEmail($_POST["email"]);
$Client -> setAddress($_POST["direccion"]);
$Client -> setTel($_POST["tel"]);

//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $Client -> updateClient();

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if($id > 0) {
header('Location: '.PROJECT_URL_ROOT.'view/admin/clientes.php');
}
?>