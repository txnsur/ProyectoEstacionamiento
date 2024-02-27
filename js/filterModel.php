<?php
//Si no se ha definido root, lo defino.
if (!defined('PROJECT_ROOT')) {
    //Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

//Obtener todos los modelos por marca.
$car = new Car();
$idMarca = $car->getMarcaID($_GET['marca']); //Buscamos el ID por select de la Marca.
$modelos = $car->getModelByID($idMarca); //Buscamos los modelos por la marca.

// Si se encontraron modelos, generar las opciones de <select>.
if ($modelos != "error") {
    // Opción por defecto.
    echo '<option value="">Seleccione un modelo</option>';

    // Iterar sobre cada modelo y crear una opción de <select> para él.
    while($row = mysqli_fetch_assoc($modelos)) {
        echo '<option value="'.$row['pk_model'].'">'.$row['model_name'].'</option>';
    }
} else {
    // Manejar el caso de que no haya modelos o haya ocurrido un error.
    echo '<option value="">No se encontraron modelos o hubo un error.</option>';
}
?>