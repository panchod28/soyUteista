<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//autoload para traer todas las clases
include("../wdywfm/myLoad.php");
//inicializo la sesion
userData::checkSession();
//inicio la sesion
$conn = Conexion::getInstance()->getConnection();
//Recibir los parametros del form
$edicion = $conn->real_escape_string($_POST['edicion']);   
$fecha = $conn->real_escape_string($_POST['fecha']);   
$url = $conn->real_escape_string($_POST['url']);
$foto = $_FILES['foto'];
$ruta_guardar = "../portadas/".$foto['name'];
$ruta_vista = "portadas/".$foto['name'];
copy($foto['tmp_name'], $ruta_guardar);
//insertar los datos   
userData::createNewsletter($_SESSION['id_usuario'], $edicion, $fecha, $ruta_vista, $url);
//redirigir al traer los datos
routesRedirect::redirectLoadData();
?>
