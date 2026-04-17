<?php
spl_autoload_register(function($class){ 
  $path = '/notificaciones/classes/';
 $extension = '.php';
 $fileName = $path.$class.$extension; 
 include $_SERVER['DOCUMENT_ROOT'].$fileName;
});
?>
