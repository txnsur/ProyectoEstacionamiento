<?php 
    //Definimos nuestro carpeta principal e incluimos la clase usuario para crear el objeto.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

    //Incluimos la clase.
    include(PROJECT_ROOT."/data/class/user.php");

    session_start();

    //Establecemos los valores de los setters de la clase user.
    $user = new User();
    $user->setNickname($_POST['nickname']);
    $user->setEmail($_POST['email']);
    $resultado = $user->getUserExist(); //Verificamos si existe un usuario con el mismo nickname o password.
    
    if($resultado) { //Vemos si ya existe un usuario con esos datos.
        echo json_encode(['status' => 'duplicate']);
    } else { //Sino existe, damos paso.
        echo json_encode(['status' => 'unique']);
    }
?>