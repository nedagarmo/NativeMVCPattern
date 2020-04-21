<?php

//Inclusion de base de datos y clase tarea
include_once '../config/BaseDatos.php';
include_once '../datos/Tarea.php';

//Instaciación de la base de datos
$baseDatos = new BaseDatos();

//Ejecución de conexión
$conexion = $baseDatos->conexion();

//Instaciación de la atrea
$tarea = new Tarea($conexion);

//Captura y asignación de variables enviadas por POST
$tarea->codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;

//Ejecución de la eliminación
$resultado = $tarea->eliminar();

//Validación del resultado de eliminación
switch ($resultado) {
    case true:
        echo "<label>Tarea removida.</label>";
        break;

    case false:
        echo "<label>No se pudo remover tarea.</label>";
        break;
    
    default:
    echo "<label>Error al remover tarea.</label>";
        break;
}

?>