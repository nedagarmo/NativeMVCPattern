<?php 

//Creacion de la clase Error
class NewError
{
    public static function throwError($code, $messsge)
    {
        //Mensaje de error
        $errMessage = "<h1>Codigo de error : $code </h1><br/><h2>$messsge</h2>";

        //Impresión de mensaje de error
        echo $errMessage; exit;
    }
}

?>

