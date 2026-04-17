<?php
include("../wdywfm/myLoad.php");
userData::checkSession();

$id = $_POST['id'];
$edicion = $_POST['edicion'];
$fecha = $_POST['fecha'];
$url = $_POST['url'];
$foto = $_FILES['foto'];

$ruta_guardar = "../portadas/".$foto['name'];
$ruta_vista = "portadas/".$foto['name'];
copy($foto['tmp_name'], $ruta_guardar);

$conn = Conexion::getInstance()->getConnection();
$sql = "UPDATE revista set edicion = '$edicion', date = '$fecha', foto = '$ruta_vista', url = '$url' WHERE id_revista = $id";
$query = mysqli_query($conn,$sql);
header("Location: ../listarRevista.php");
?>
