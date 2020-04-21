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

$html = "";

//Ejecución de la consulta
$resultado = $tarea->leerTodos();

//Proceso de creación de la respuesta
$cantidad = $resultado->rowCount();

    if($cantidad > 0)
    {
        //Inicialización de matrices
        $resultado_array = array();
        $activos_array = array();

        //Captura de la respuesta y volcado a matriz
        while($datos = $resultado->fetch(PDO::FETCH_ASSOC)){
            extract($datos);
    
            $resultado_items = array(
                'codigo' => $codigo,
                'nombre'=> $nombre,
                'descripcion' => $descripcion,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'estado' => $estado
            );

            array_push($resultado_array, $resultado_items);
        }

        foreach ($resultado_array as $valor) 
        {
            if($valor["estado"] == 1)
            {
                array_push($activos_array, $valor);
            }
        }
        
        //Construcción de respuesta html
        for($i = 0; $i < count($resultado_array) ; $i++)
        {
            $html .= "<div class='col-md-4'>
            <div class='card  bg-dark text-white border-success'>
                <div class='card-header border-success'>
                ".$resultado_array[$i]["fechaInicio"]." / ".$resultado_array[$i]["fechaFin"]."
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>".strtoupper($resultado_array[$i]["nombre"])."</h5>
                    <p class='card-text'>".ucfirst($resultado_array[$i]["descripcion"]).".</p>
                    <button onclick='removerTarea(".$resultado_array[$i]["codigo"].");' class='btn btn-danger btn-lg btn-block'>Remover</button>
                </div>
            </div>
        </div>"; 

        }

        echo $html;
    }
    else{
        echo "<label>No existen tareas pendientes.</label>";
    }

?>