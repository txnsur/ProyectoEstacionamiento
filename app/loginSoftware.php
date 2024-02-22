<?php 
    //Definimos nuestro carpeta principal e incluimos la clase usuario para crear el objeto.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

    include(PROJECT_ROOT."/data/class/user.php");

    //Creamos nuestro objeto de usuario.
    $myUser = new User(); 

    //Capturamos los valores del login.html para settear los atributos de la clase usuario.
    $myUser->setNickname($_POST['username']); 
    $myUser->setPassword($_POST['password']); 

    //Hacemos la consulta en busca de nuestro usuario.
    $dataSet = $myUser->getUser(); 

    //Inicimos el proceso de busqueda.
    if($dataSet != 'error') { 
        $count = mysqli_num_rows($dataSet); //Contamos si encontro una coincidencia.
            if($count == 1) { //Si es asi, iniciamos la sesion.

                session_start();
                $tupla = mysqli_fetch_assoc($dataSet); //Capturamos los valores de la fila de la consulta.

                //Le ponemos un alias a nuestro campo por seguridad.
                $_SESSION['user_id'] = $tupla['pk_user']; 
                $_SESSION['user'] = $tupla['nickname']; 
                $_SESSION['mail'] = $tupla['email']; 

                //Redireccionamos hacia los archivos del admin en caso de serlo.
                echo "Si existe en el usuario";
                header('Location: '.PROJECT_URL_ROOT.'index.php');
            } else {
                //Redireccionamos hacia los archivos del cliente (empresa) en caso de no serlo.
                echo "No se ha encontrado ningun usuario";
                header('Location: '.PROJECT_URL_ROOT.'view/login.html');
            }
    } else {
        echo "error en loginSoftware.php";
    }
?>