<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include("../wdywfm/myLoad.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Allow: GET");
echo json_encode(userData::retrieveNews());
?>
