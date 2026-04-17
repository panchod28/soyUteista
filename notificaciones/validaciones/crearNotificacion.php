<?php
include("../wdywfm/myLoad.php");
userData::checkSession();
$conn = Conexion::getInstance()->getConnection();
$c = uniqid (rand (),true);
$titulo = $conn->real_escape_string($_POST['titulo']);   
$cuerpo = $conn->real_escape_string($_POST['cuerpo']);   
$link = $conn->real_escape_string($_POST['link']);   
userData::createNotification($_SESSION['id_usuario'], md5($c), $titulo, $cuerpo, $link);
routesRedirect::redirectLoadData();
?>
