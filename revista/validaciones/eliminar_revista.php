<?php
include("../wdywfm/myLoad.php");
userData::checkSession();
$id = $_GET['id'];

$conn = Conexion::getInstance()->getConnection();
$sql = "DELETE FROM revista WHERE id_revista = $id";
$query = mysqli_query($conn,$sql);
header("Location: ../listarRevista.php");
?>
