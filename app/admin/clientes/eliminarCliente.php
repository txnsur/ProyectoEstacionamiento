<?php 
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

    //Incluimos la clase cliente.
    include(PROJECT_ROOT . '/data/class/client.php');

    //Creamos nuestro objeto
    $client = new Client();
    $client->setID($_POST['id']);

    //Llamamos al metodo de eliminacion del cliente.
    $id = $client->deleteClient();

    //Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
    if($id > 0) {
    header('Location: '.PROJECT_URL_ROOT.'view/admin/clientes.php');
    }
?>