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
$tarea->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$tarea->descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$tarea->fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : null;
$tarea->fechaFin = isset($_POST['fechaFin']) ? $_POST['fechaFin'] : null;
$tarea->estado = 1;

$procede = true;

//Validación de fecha
if($tarea->fechaInicio != null &&  $tarea->fechaFin != null) 
{
    if($tarea->fechaInicio > $tarea->fechaFin)
    {
        $procede = false;
        echo "<label>La fecha de inicio debe ser menor o igual a la fecha fin.</label>";
    }  
}

if($procede)
{
    //Ejecución de la inserción
    $resultado = $tarea->insertar();

    if($resultado){
        echo "<label>Tarea creada.</label>";
    }
    elseif(!$resultado){
        echo "<label>No se pudo crear tarea.</label>";
    }else{
        echo "<label>Error al crear tarea.</label>";
    }
}

?>