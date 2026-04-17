<?php
spl_autoload_register(function($class){ 
  $path = '/revista/classes/';
 $extension = '.php';
 $fileName = $path.$class.$extension;
 include $_SERVER['DOCUMENT_ROOT'].$fileName;
});
?>
