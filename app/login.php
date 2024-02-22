<?php 
    //Definimos nuestro carpeta principal e incluimos la clase usuario para crear el objeto.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

    include(PROJECT_ROOT."/data/class/user.php");

    //Creamos nuestro objeto de usuario y cliente.
    $myUser = new User(); 

    //Capturamos los valores del login.html para settear los atributos de la clase usuario.
    $myUser->setNickname($_POST['username']); 

    //Inner join entre las tablas de usuarios hasta la tabla de donde esta el codigo generado por la licencia.
    //Hacemos la consulta en busca de nuestro usuario.
    $dataSet = $myUser->getUserAccess($_POST['accessCode']); 

    $tupla = mysqli_fetch_assoc($dataSet); //Capturamos los valores de la fila de la consulta.

    //Inicimos el proceso de busqueda.
    if($dataSet != 'error' && $tupla['category'] == 'A') { 
        $count = mysqli_num_rows($dataSet); //Contamos si encontro una coincidencia.
            if($count == 1) { //Si es asi, iniciamos la sesion.

                session_start();

                //Le ponemos un alias a nuestro campo por seguridad.
                $_SESSION['user_id'] = $tupla['pk_user']; 
                $_SESSION['user'] = $tupla['nickname']; 
                $_SESSION['mail'] = $tupla['email']; 

                //Redireccionamos hacia los archivos del admin en caso de serlo.
                echo "Eres admin";
                echo '
                <script type="text/javascript">
                    var nickname = "' . $_SESSION['user'] . '";
                </script>
                <script src="'.PROJECT_URL_ROOT.'js/accesoGranted.js"></script>';
            } 
    } else if ($dataSet != 'error' && $tupla['category'] == 'C'){

        //Redireccionamos hacia los archivos del cliente (empresa) en caso de no ser admin.
        session_start();

        //Le ponemos un alias a nuestro campo por seguridad.
        $_SESSION['user_id'] = $tupla['pk_user']; 
        $_SESSION['user'] = $tupla['nickname']; 
        $_SESSION['mail'] = $tupla['email']; 

        //echo "Eres cliente (empresa)";
        //echo $_SESSION['user_id']; //Ver id del usuario.
        //echo $_SESSION['user']; //Ver el nombre del usuario.
        
        //Le mandamos el nombre de usuario a nuestro javascript.
        header('Content-type: text/html; charset=utf-8');
        echo '
        <script type="text/javascript">
            var nickname = "' . $_SESSION['user'] . '";
        </script>
        <script src="'.PROJECT_URL_ROOT.'js/accesoGranted_C.js"></script>';
    } else {
        echo 'Usuario no encontrado';
        // echo $dataSet; viendo los errores.
        echo '<script src="'.PROJECT_URL_ROOT.'js/accesoDenegado.js"></script>';
    }
?>