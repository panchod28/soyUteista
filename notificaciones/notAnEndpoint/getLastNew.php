<?php
include("../wdywfm/myLoad.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Allow: GET");
echo json_encode(userData::retrieveLastNew());
?>