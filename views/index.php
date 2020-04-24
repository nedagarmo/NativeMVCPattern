<?php
/**
 * Clase de seguridad para evitar que accedan al directorio en caso
 * que el servidor esté configurado para mostrar los archivos a manera de 
 * exploración.
*/
header('Location: ../index.php'); 
die();
?>